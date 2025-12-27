<?php

namespace App\Http\Controllers;

use App\Models\JobBrand;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class JobBrandController extends Controller
{
    public function index()
    {
        $jobBrands = JobBrand::with('category')->latest()->paginate(10);


        return view('admin.pages.jobbrand.list', compact('jobBrands'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.pages.jobbrand.create', compact('categories'));
    }

    public function store(Request $request)
    {

        
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:job_brands',
            'image' => 'nullable|image',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/jobbrand'), $imageName);
        }
        if ($request->status) {
            $status = 1;
        } else {
            $status = 0;
        }
        JobBrand::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imageName,
            'status' => $status,
        ]);

        return redirect()->route('jobbrand.index')
            ->with('success', 'Job brand created successfully.');
    }

    public function edit($id)
    {
        $jobBrand = JobBrand::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('admin.pages.jobbrand.edit', compact('jobBrand', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $jobBrand = JobBrand::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:job_brands,slug,' . $id,
            'image' => 'nullable|image',
        ]);

        $imageName = $jobBrand->image;

        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('uploads/jobbrand/' . $imageName))) {
                unlink(public_path('uploads/jobbrand/' . $imageName));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/jobbrand'), $imageName);
        }

        $jobBrand->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imageName,
            'status' => $request->status,
        ]);

        return redirect()->route('jobbrand.index')
            ->with('success', 'Job brand updated successfully.');
    }

    public function destroy($id)
    {
        $jobBrand = JobBrand::findOrFail($id);

        if ($jobBrand->image && file_exists(public_path('uploads/jobbrand/' . $jobBrand->image))) {
            unlink(public_path('uploads/jobbrand/' . $jobBrand->image));
        }

        $jobBrand->delete();

        return redirect()->route('jobbrand.index')
            ->with('success', 'Job brand deleted successfully.');
    }
}
