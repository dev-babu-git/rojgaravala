<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\DescriptionPage;
use App\Models\EducationJob;
use App\Models\JobBrand;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DescriptionPageController extends Controller
{
    /**
     * Show All Description Pages
     */
    public function index(Request $request)
    {
        $query = DescriptionPage::with(['category', 'user']);

        // MULTISELECT FIELDS ARE NOT RELATIONS ANYMORE
        // REMOVE ->subcategory

        // FILTER: Title
        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // FILTER: Status
        if ($request->status !== null && $request->status !== "") {
            $query->where('status', $request->status);
        }

        // FILTER: Category
        if ($request->from_date && $request->to_date) {
            $query->whereBetween('created_at', [
                $request->from_date . " 00:00:00",
                $request->to_date . " 23:59:59"
            ]);
        }
        // If only from_date
        elseif ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        // If only to_date
        elseif ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        if ($request->author_id) {
            $query->where('created_by', $request->author_id);
        }

        // FILTER: Date
        if ($request->created_at) {
            $query->whereDate('created_at', $request->created_at);
        }

        // FILTER: Subcategory (MULTISELECT)
        if ($request->subcategory_id) {
            $query->whereRaw(
                "FIND_IN_SET(?, subcategory_id)",
                [$request->subcategory_id]
            );
        }

        // FILTER: State (MULTISELECT)
        if ($request->state) {
            $query->whereRaw(
                "FIND_IN_SET(?, state)",
                [$request->state]
            );
        }

        // FILTER: JobBrand (MULTISELECT)
        if ($request->jobbrand) {
            $query->whereRaw(
                "FIND_IN_SET(?, jobbrand)",
                [$request->jobbrand]
            );
        }

        // FILTER: Eligibility (MULTISELECT)
        if ($request->eligibility) {
            $query->whereRaw(
                "FIND_IN_SET(?, eligibility)",
                [$request->eligibility]
            );
        }

        // LIMIT NON-ADMIN USERS
        if (auth()->user()->role !== 'saysadmin') {
            $query->where('status', '!=', 1)
                ->where('created_by', auth()->id());
        }

        // PAGINATION
        $pagesData = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.pages.description-pages.list', compact('pagesData'));
    }


    /**
     * Create Page Form
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('name')->get();
        $brands = JobBrand::where('status', 1)->get(); // JobBrand dropdown
        $states = State::where('status', 1)->get(); // JobBrand dropdown
        $education = EducationJob::where('status', 1)->get(); // JobBrand dropdown

        return view('admin.pages.description-pages.create', compact('categories', 'brands', 'states', 'education'));
    }

    /**
     * Store New Page
     */

    public function store(Request $request)
    {


        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required|array',
            'subcategory_id.*' => 'integer',
            'eligibility' => 'required|array',
            'state' => 'required|array',
            'jobbrand' => 'required|array',
            'name' => 'required',
            'slug' => 'required|unique:description_pages,slug',
            'content' => 'required',
        ]);
        DescriptionPage::create([
            'created_by'     => auth()->id(),
            'category_id'    => $request->category_id,
            'subcategory_id' => implode(',', $request->subcategory_id),
            'eligibility'    => implode(',', $request->eligibility),
            'state'          => implode(',', $request->state),
            'jobbrand'       => implode(',', $request->jobbrand),
            'title'          => $request->name,
            'slug'           => $request->slug,
            'content'        => $request->content,
            'status'         => 0,
            'meta_title'     => $request->meta_title,
            'meta_keywords'  => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);


        return redirect()->route('description-pages.index')
            ->with('success', 'Description created successfully');
    }


    /**
     * Edit Page Form
     */
    public function edit(DescriptionPage $description_page)
    {
        $categories = Category::where('status', 1)->orderBy('name')->get();
        $eligibilityOptions = EducationJob::where('status', 1)->get();
        $stateOptions = State::where('status', 1)->get();
        $brands = JobBrand::where('status', 1)->get();
        $subcategories = Subcategory::where('category_id', $description_page->category_id)
            ->where('status', 1)->get();




        return view('admin.pages.description-pages.edit', compact('description_page', 'categories', 'subcategories', 'eligibilityOptions', 'stateOptions', 'brands'));
    }

    /**
     * Update Page
     */
    public function update(Request $request, DescriptionPage $descriptionPage)
    {
        $request->validate([
            'category_id' => 'required',
            'eligibility' => 'required|array',
            'state' => 'required|array',
            'jobbrand' => 'required|array',
            'title' => 'required|string|max:255',

        ]);

        $descriptionPage->update([
            'created_by'      => auth()->id(),
            'category_id'     => $request->category_id,
            'subcategory_id'  => implode(',', $request->subcategory_id),
            'eligibility'     => implode(',', $request->eligibility),
            'state'           => implode(',', $request->state),
            'jobbrand'        => implode(',', $request->jobbrand),
            'title'           => $request->title,
            'slug'            => $request->slug,
            'content'         => $request->content,
            'status'          => $request->status ?? 0,
            'meta_title'      => $request->meta_title,
            'meta_keywords'   => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);


        return redirect()->route('description-pages.index')
            ->with('success', 'Description updated successfully');
    }



    /**
     * Delete Page
     */
    public function destroy(DescriptionPage $description_page)
    {
        $description_page->delete();

        return redirect()->route('description-pages.index')
            ->with('success', 'Description Page deleted successfully.');
    }
}
