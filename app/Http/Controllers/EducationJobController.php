<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationJob;

class EducationJobController extends Controller
{
    public function index(Request $request)
    {
        $query = EducationJob::query();

        if ($request->title) {
            $query->where('title', 'like', '%'.$request->title.'%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $educationJobs = $query->latest()->paginate(10);

        return view('admin.pages.education_jobs.list', compact('educationJobs'));
    }

    public function create()
    {
        return view('admin.pages.education_jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255|unique:education_jobs,title',
            'status' => 'required|in:0,1',
        ]);

        EducationJob::create($request->all());

        return redirect()->route('education-jobs.index')->with('success', 'Education Job created successfully');
    }

    public function edit($id)
    {
        $job = EducationJob::findOrFail($id);
        return view('admin.pages.education_jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = EducationJob::findOrFail($id);

        $request->validate([
            'title'  => 'required|string|max:255|unique:education_jobs,title,'.$id,
            'status' => 'required|in:0,1',
        ]);

        $job->update($request->all());

        return redirect()->route('education-jobs.index')->with('success', 'Education Job updated successfully');
    }

    public function destroy($id)
    {
        $job = EducationJob::findOrFail($id);
        $job->delete();

        return redirect()->route('education-jobs.index')->with('success', 'Education Job deleted successfully');
    }
}
