<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Imports\QuestionsOptionsImport;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with('test');

        if ($request->question) {
            $query->where('question_text', 'like', '%' . $request->question . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $questions = $query->latest()->paginate(10);

        return view('admin.pages.questions.list', compact('questions'));
    }

    // Create form
    public function create()
    {
        $tests = Test::all(); // dropdown
        return view('admin.pages.questions.create', compact('tests'));
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'test_id' => 'required|exists:tests,id',
            'question_text' => 'required|string',
            'marks' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        Question::create([
            'test_id' => $request->test_id,
            'question_text' => $request->question_text,
            'marks' => $request->marks,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('questions.index')
            ->with('success', 'Question inserted successfully');
    }

    // Edit form
    public function edit(Question $question)
    {
        $tests = Test::all();
        return view('admin.pages.questions.edit', compact('question', 'tests'));
    }

    // Update
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'test_id' => 'required|exists:tests,id',
            'question_text' => 'required|string',
            'marks' => 'required|integer',
            'status' => 'required',
        ]);

        $question->update($request->all());

        return redirect()
            ->route('questions.index')
            ->with('success', 'Question updated successfully');
    }

    // Delete
    public function destroy(Question $question)
    {
        $question->delete();

        return back()->with('success', 'Question deleted');
    }



    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx'
        ]);

        $import = new QuestionsOptionsImport();
        Excel::import($import, $request->file('file'));

        if (!empty($import->errors)) {
            return redirect()
                ->back()
                ->with('import_errors', $import->errors);
        }

        return redirect()
            ->route('questions.index')
            ->with('success', 'Questions uploaded successfully');
    }
}
