<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\Exam;

class ExamController extends Controller
{
    /**
     * Display a listing of exams
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
        return view('admin.pages.exams.list', compact('exams'));
    }

    /**
     * Show the form for creating a new exam
     */
    public function create()
    {
        return view('admin.pages.exams.create');
    }

    /**
     * Store a newly created exam
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:exams,slug',
            'status' => 'required'
        ]);

        Exam::create($validated);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam created successfully');
    }

    /**
     * Show the form for editing the exam
     */
    public function edit(Exam $exam)
    {
        return view('admin.pages.exams.edit', compact('exam'));
    }

    /**
     * Update the exam
     */
    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:exams,slug,' . $exam->id,
            'status' => 'required',
        ]);

        $exam->update($validated);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam updated successfully');
    }

    /**
     * Remove the exam
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam deleted successfully');
    }
}
