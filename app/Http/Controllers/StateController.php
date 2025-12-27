<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = State::query();

        // FILTER BY NAME
        if ($request->name) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }

        // FILTER BY STATUS
        if ($request->status != "") {
            $query->where('status', $request->status);
        }

        $states = $query->latest()->paginate(10);

        return view('admin.pages.states.list', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.states.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255|unique:states,name',
            'status' => 'required|in:0,1',
        ]);

        State::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('states.index')
            ->with('success', 'State created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $state = State::findOrFail($id);

        return view('admin.pages.states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $state = State::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255|unique:states,name,'.$id,
            'status' => 'required|in:0,1',
        ]);

        $state->update([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('states.index')
            ->with('success', 'State updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = State::findOrFail($id);
        $state->delete();

        return redirect()
            ->route('states.index')
            ->with('success', 'State deleted successfully');
    }
}
