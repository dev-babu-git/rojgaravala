<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Question;

class OptionController extends Controller
{
    /**
     * Display a listing of the options.
     */
    public function index(Request $request)
{
    $query = Option::with('question');

    // 🔍 Filter by Question
    if ($questionId = $request->query('question_id')) {
        $query->where('question_id', $questionId);
    }

   
    // 🔍 Search by Option Text
    if ($search = $request->query('search')) {
        $query->where('option_text', 'like', "%{$search}%");
    }

    // 📄 Pagination
    $options = $query->orderBy('id', 'desc')
                     ->paginate(10)
                     ->withQueryString(); // keep query parameters on pagination links

    $questions = Question::all(); // For filter dropdown

    return view('admin.pages.options.list', compact('options', 'questions'));
}


    /**
     * Show the form for creating a new option.
     */
    public function create()
    {
        $questions = Question::all(); // Get all questions
        return view('admin.pages.options.create', compact('questions'));
    }

    /**
     * Store a newly created option in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'option_text.*' => 'required|string',
            'status' => 'required',
        ], [
            'option_text.*.required' => 'Each option text is required',
        ]);

        $questionId = $request->question_id;
        $status = $request->status;
        $optionTexts = $request->option_text;
        $corrects = $request->is_correct ?? []; // array of checked indexes

        foreach ($optionTexts as $index => $text) {
            Option::create([
                'question_id' => $questionId,
                'option_text' => $text,
                'is_correct' => in_array($index, array_keys($corrects)) ? 1 : 0,
                'status' => $status,
            ]);
        }

        return redirect()->route('options.index')
            ->with('success', 'Options added successfully');
    }


    /**
     * Show the form for editing the specified option.
     */
    public function edit(Option $option)
    {
        $questions = Question::all();
        return view('admin.pages.options.edit', compact('option', 'questions'));
    }

    /**
     * Update the specified option in storage.
     */
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'option_text' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $option->update([
            'question_id' => $request->question_id,
            'option_text' => $request->option_text,
            'is_correct' => $request->has('is_correct') ? 1 : 0,
            'status' => $request->status,
        ]);

        return redirect()->route('options.index')
            ->with('success', 'Option updated successfully.');
    }

    /**
     * Remove the specified option from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return redirect()->route('options.index')
            ->with('success', 'Option deleted successfully.');
    }
}
