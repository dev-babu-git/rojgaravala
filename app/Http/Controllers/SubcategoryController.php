<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of subcategories.
     */
    public function index(Request $request)
    {

        $query = Subcategory::with('category');

        // Filter by Name
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by Status
        if ($request->status !== null && $request->status !== "") {
            $query->where('status', $request->status);
        }

        // Filter by Category
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $subcategories = $query->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.subcategories.list', compact('subcategories'));
    }
    /**
     * Show the form for creating a new subcategory.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('name')->get();

        return view('admin.pages.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created subcategory.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:subcategories,slug',
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1'
        ]);

        // Slug auto-create if empty
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        Subcategory::create($data);

        return redirect()->route('subcategories.index')
            ->with('success', 'Subcategory created successfully.');
    }

    /**
     * Show the form for editing a subcategory.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::where('status', 1)->orderBy('name')->get();

        return view('admin.pages.subcategories.edit', compact('subcategory', 'categories'));
    }



    /**
     * Update a subcategory.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:subcategories,slug,' . $subcategory->id,
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1'
        ]);

        // Auto slug
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $subcategory->update($data);

        return redirect()->route('subcategories.index')
            ->with('success', 'Subcategory updated successfully.');
    }

    /**
     * Remove a subcategory.
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('subcategories.index')
            ->with('success', 'Subcategory deleted successfully.');
    }

    public function getByCategory($categoryId)
    {
       
        return Subcategory::where('category_id', $categoryId)
            ->where('status', 1)
            ->get();
    }
}
