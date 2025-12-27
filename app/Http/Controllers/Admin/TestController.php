<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\DescriptionPage;

class TestController extends Controller
{
    // List
    public function index(Request $request)
    {

        $query = Test::query();

        // Filter by title
        if ($title = $request->query('title')) {
            $query->where('title', 'like', "%{$title}%");
        }

        // Filter by status
        if ($status = $request->query('status')) {
            if (in_array($status, ['active', 'inactive'])) {
                $query->where('status', $status);
            }
        }

        $testData = $query->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();
            $testData = $query->orderBy('id', 'desc')
    ->paginate(5)
    ->withQueryString();

        return view('admin.pages.tests.list', compact('testData'));
    }


    // Store
    public function create()
    {
        $examData = DescriptionPage::all();
        return view('admin.pages.tests.create', compact('examData'));
    }

    // Store
    public function store(Request $request)
    {
        // Step 1: Validate input
        $validated = $request->validate([
            'exam_id'     => 'required',
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|unique:tests,slug',
            'duration'    => 'required|integer|min:1',
            'total_marks' => 'required|integer|min:1',
            'status'      => 'nullable|in:active,inactive',
        ]);

        // Step 2: Generate slug if not provided
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        // Step 3: Ensure slug is unique
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Test::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        // Step 4: Set default status if not provided
        $validated['status'] = $validated['status'] ?? 'inactive';

        // Step 5: Insert into database
        try {
            Test::create($validated);

            return redirect()
                ->route('tests.index')
                ->with('success', 'Test created successfully.');
        } catch (\Exception $e) {
            // Agar database insert me error ho
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }

    // Edit Form
    public function edit(Test $test)
    {
        $examData = DescriptionPage::all();

        return view(
            'admin.pages.tests.edit',
            compact('test', 'examData')
        );
    }

    // Update
    public function update(Request $request, Test $test)
    {
        $validated = $request->validate([
            'exam_id'      => 'required|exists:exams,id',
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|unique:tests,slug,' . $test->id,
            'duration'     => 'required|integer|min:1',
            'total_marks'  => 'required|integer|min:1',
            'status'       => 'required|in:active,inactive',
        ]);

        $validated['slug'] = $validated['slug']
            ?? Str::slug($validated['title']);

        $test->update($validated);

        return redirect()
            ->route('tests.index')
            ->with('success', 'Test updated successfully.');
    }

    // Delete
    public function destroy(Test $test)
    {
        $test->delete();

        return redirect()->route('tests.index')
            ->with('success', 'Test deleted successfully.');
    }
}
