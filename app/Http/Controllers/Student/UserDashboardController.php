<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\StudentAnswer;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserDashboardController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('usersPage.pages.index', compact('tests'));
    }

    public function startTest(Test $test)
    {
        // Get current question number from session
        $qno = session('current_qno', 1);

        $question = $test->questions()
            ->orderBy('id')
            ->skip($qno - 1)
            ->first();

        if (!$question) {
            // Test finished
            session()->forget('current_qno');
            return redirect()->route('student.test.submit', $test->id);
        }

        return view('usersPage.pages.startTest', compact('test', 'question', 'qno'));
    }


    public function saveAnswer(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'test_id' => 'required|exists:tests,id',
            'question_id' => 'required|exists:questions,id',
            'option_id' => 'required|exists:options,id',
        ], [
            'test_id.required' => 'Test ID is required.',
            'test_id.exists' => 'Invalid test selected.',
            'question_id.required' => 'Question ID is required.',
            'question_id.exists' => 'Invalid question selected.',
            'option_id.required' => 'You must select an option.',
            'option_id.exists' => 'Invalid option selected.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save or update answer
        StudentAnswer::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'question_id' => $request->question_id,
            ],
            [
                'test_id'   => $request->test_id,
                'option_id' => $request->option_id,
            ]
        );

        // Session based question number (Recommended)
        $current_qno = session('current_qno', 1);
        session(['current_qno' => $current_qno + 1]);

        return redirect()->route('student.tests.start', $request->test_id);
    }


    public function submit(Test $test)
    {
        $answers = StudentAnswer::with(['question', 'option'])
            ->where('user_id', auth()->id())
            ->where('test_id', $test->id)
            ->get();

        $totalQuestions = $answers->count();
        $right = 0;
        $wrong = 0;

        $wrongQuestions = [];

        foreach ($answers as $ans) {

            if ($ans->option && $ans->option->is_correct) {
                $right++;
            } else {
                $wrong++;

                // correct option fetch
                $correctOption = $ans->question
                    ? $ans->question->options()->where('is_correct', 1)->first()
                    : null;

                $wrongQuestions[] = [
                    'question'        => $ans->question->question_text ?? '-',
                    'user_answer'     => $ans->option->option_text ?? 'Not Answered',
                    'correct_answer' => $correctOption->option_text ?? '-',
                ];
            }
        }

        $score = $right; // ya $right * marks

        return view('usersPage.pages.testResult', compact(
            'score',
            'totalQuestions',
            'right',
            'wrong',
            'wrongQuestions'
        ));
    }

    public function  getSettings()
    {
        $student = User::with('student')
            ->where('id', auth()->id())
            ->first();

        return response()->json($student);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6'
        ]);

        $user = auth()->user();

        // Update USER
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password')
                ? bcrypt($request->password)
                : $user->password,
        ]);

        // Update STUDENT (enrollment_no IGNORE)
        $user->student()->update([
            'phone' => $request->phone,
            'course' => $request->course,
        ]);

        return response()->json([
            'success' => 'Profile updated successfully'
        ]);
    }
}
