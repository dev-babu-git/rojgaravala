<?php

namespace App\Http\Controllers;

use App\Models\WebsitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsitePageController extends Controller
{
    public function index()
    {
        $listData = WebsitePage::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.website-pages.list', compact('listData'));
    }

    public function create()
    {
        return view('admin.pages.website-pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:website_pages,slug',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Auto slug
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        WebsitePage::create($data);

        return redirect()->route('website-pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function show(WebsitePage $websitePage)
    {
        return view('admin.pages.website-pages.show', compact('websitePage'));
    }

    public function edit(WebsitePage $websitePage)
    {
        $editData=$websitePage;
        return view('admin.pages.website-pages.edit', compact('editData'));
    }


    public function update(Request $request, WebsitePage $websitePage)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:website_pages,slug,' . $websitePage->id,
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        // Auto slug
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        // Fix: correct variable name is $websitePage
        $websitePage->update($data);

        return redirect()->route('website-pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(WebsitePage $websitePage)
    {
        $websitePage->delete();

        return redirect()->route('website-pages.index')
            ->with('success', 'Website page deleted.');
    }
}
