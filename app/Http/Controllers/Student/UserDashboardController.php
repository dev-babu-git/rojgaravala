<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\TestAttempt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserDashboardController extends Controller
{
    
   public function index()
{
    $userId = auth()->id();

    $totalTests = Test::count();

    $completedTests = TestAttempt::where('user_id', $userId)
        ->where('status', 'completed')
        ->count();

    $pendingTests = TestAttempt::where('user_id', $userId)
        ->where('status', 'started')
        ->count();

    // Score avg
    $totalCorrect = DB::table('student_answers')
        ->join('options', 'student_answers.option_id', '=', 'options.id')
        ->where('student_answers.user_id', $userId)
        ->where('options.is_correct', 1)
        ->count();

    $totalAttempted = DB::table('student_answers')
        ->where('user_id', $userId)
        ->count();

    $averageScore = $totalAttempted > 0
        ? round(($totalCorrect / $totalAttempted) * 100, 2)
        : 0;

    // 🔥 MY TESTS (IMPORTANT)
    $myTests = TestAttempt::with(['test.exam'])
        ->where('user_id', $userId)
        ->latest()
        ->get();

    return view('student.pages.index', compact(
        'totalTests',
        'completedTests',
        'pendingTests',
        'averageScore',
        'myTests'
    ));
}


   public function myTests()
{
    $userId = auth()->id();

    $myTests = TestAttempt::with(['test.exam', 'test.questions'])
        ->where('user_id', $userId)
        ->latest()
        ->get()
        ->unique('test_id');

    return view('student.pages.my-tests', compact('myTests'));
}
  
    public function startTest(Test $test)
    {

        $userId = auth()->id();
        $maxAttempts = 100;

        $usedAttempts = TestAttempt::where('user_id', $userId)
            ->where('test_id', $test->id)
            ->where('status', 'completed')
            ->count();

        if ($usedAttempts >= $maxAttempts) {
            return back()->with('error', 'Attempts over');
        }

        // Get or create active attempt
        TestAttempt::firstOrCreate(
            [
                'user_id' => $userId,
                'test_id' => $test->id,
                'status'  => 'started',
            ],
            [
                // 'attempt_no' => $usedAttempts + 1,
                'started_at' => now(),
            ]
        );

        session(['current_qno' => 1]);

        return redirect()->route('student.tests.question', $test->id);
    }


    /* ===============================
        SHOW QUESTION
    =============================== */
    public function showQuestion(Test $test)
    {
        $qno = session('current_qno', 1);

        $totalQuestions = $test->questions()->count();

        if ($qno < 1) {
            $qno = 1;
        }

        if ($qno > $totalQuestions) {
            return redirect()->route('student.tests.submit', $test->id);
        }

        $question = $test->questions()
            ->orderBy('id')
            ->skip($qno - 1)
            ->first();

        if (!$question) {
            return redirect()->route('student.tests.submit', $test->id);
        }

        // already selected option (for previous)
        $selectedOption = StudentAnswer::where('user_id', auth()->id())
            ->where('question_id', $question->id)
            ->value('option_id');
        // dd($selectedOption);
        return view('student.pages.startTest', compact(
            'test',
            'question',
            'qno',
            'totalQuestions',
            'selectedOption'
        ));
    }


    /* ===============================
        SAVE ANSWER
    =============================== */
    public function saveAnswer(Request $request)
    {
        $request->validate([
            'test_id' => 'required',
            'question_id' => 'required',
            'option_id' => 'nullable',
            'action' => 'required'
        ]);

        if ($request->option_id) {
            StudentAnswer::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'question_id' => $request->question_id,
                ],
                [
                    'test_id' => $request->test_id,
                    'option_id' => $request->option_id,
                ]
            );
        }

        $qno = session('current_qno', 1);

        if ($request->action === 'next') {
            session(['current_qno' => $qno + 1]);
        }

        if ($request->action === 'prev') {
            session(['current_qno' => max(1, $qno - 1)]);
        }
        if ($request->action === 'submit') {
            return redirect()->route('student.tests.submit', $request->test_id);
        }
        return redirect()->route('student.tests.question', $request->test_id);
    }


    /* ===============================
        SUBMIT TEST
    =============================== */

    public function submit(Test $test)
    {
        $userId = auth()->id();

        // Close test attempt
        TestAttempt::where('user_id', $userId)
            ->where('test_id', $test->id)
            ->where('status', 'started')
            ->update([
                'status' => 'completed',
                'submitted_at' => now(),
            ]);

        session()->forget('current_qno');

        $answers = StudentAnswer::with([
            'question.options',
            'option'
        ])
            ->where('user_id', $userId)
            ->where('test_id', $test->id)
            ->get();

        $right = 0;
        $wrong = 0;
        $wrongQuestions = [];

        foreach ($answers as $ans) {

            $correctOption = $ans->question
                ? $ans->question->options->where('is_correct', 1)->first()
                : null;

            if ($ans->option && $ans->option->is_correct) {
                $right++;
            } else {
                $wrong++;

                $wrongQuestions[] = [
                    'question'        => $ans->question?->question_text ?? '-',
                    'your_answer'     => $ans->option?->option_text ?? 'Not Answered',
                    'correct_answer' => $correctOption?->option_text ?? '-',
                ];
            }
        }

        $totalQuestions = $test->questions()->count();

        $percentage = $totalQuestions > 0
            ? round(($right / $totalQuestions) * 100, 2)
            : 0;

        $status = $percentage >= 40 ? 'Pass' : 'Fail';

        return view('student.pages.testResult', compact(
            'right',
            'wrong',
            'totalQuestions',
            'percentage',
            'status',
            'wrongQuestions'
        ));
    }


 public function result(TestAttempt $attempt)
{
    // 🔐 Security check
    if ($attempt->user_id !== auth()->id()) {
        abort(403);
    }

    $test = $attempt->test;

    $questions = $test->questions()->with('options')->get();

    $answers = StudentAnswer::where('user_id', auth()->id())
        ->where('test_id', $test->id)
        ->get()
        ->keyBy('question_id');

    $correct = 0;
    $wrong = 0;
    $unattempted = 0;

    $resultData = [];

    foreach ($questions as $q) {

        $studentAnswer = $answers->get($q->id);
        $correctOption = $q->options->where('is_correct', 1)->first();

        if (!$studentAnswer) {
            $unattempted++;
            $status = 'unattempted';
        } elseif ($studentAnswer->option_id == optional($correctOption)->id) {
            $correct++;
            $status = 'correct';
        } else {
            $wrong++;
            $status = 'wrong';
        }

        $resultData[] = [
            'question'       => $q->question_text,
            'your_answer'    => $studentAnswer->option->option_text ?? 'Not Attempted',
            'correct_answer' => $correctOption->option_text ?? '-',
            'status'         => $status,
        ];
    }

    $total = $questions->count();
    $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
    $resultStatus = $percentage >= 40 ? 'Pass' : 'Fail';

    return view('student.pages.result', compact(
        'test',
        'attempt',
        'total',
        'correct',
        'wrong',
        'unattempted',
        'percentage',
        'resultStatus',
        'resultData'
    ));
}
}
