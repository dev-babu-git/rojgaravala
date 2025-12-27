<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // List
     
     public function index(Request $request)
    {
        $query = Category::query();

        // Filter by name
        if ($name = $request->query('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        // Filter by status
        if ($status = $request->query('status')) {
            if ($status === '1' || $status === '0') {
                $query->where('status', $status);
            }
        }

        // Pagination
        $categories = $query->orderBy('id', 'desc')->paginate(5)->withQueryString();

        return view('admin.pages.categories.list', compact('categories'));
    }

    // Create Form
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    // Store
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'status' => 'nullable|in:0,1',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['status'] = $data['status'] ?? 1;

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    // Edit Form
    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit', compact('category'));
    }

    // Update
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'status' => 'nullable|in:0,1',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['status'] = $data['status'] ?? 1;

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    // Delete
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}
