<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\DescriptionPage;
use App\Models\EducationJob;
use App\Models\JobBrand;
use App\Models\Page;
use App\Models\State;
use App\Models\Test;
use App\Models\WebsitePage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function home()
    {
        // Basic data
        $educations = EducationJob::where('status', 1)->get();
        $jobStates = State::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $jobBrands = JobBrand::where('status', 1)->get();

        // Category + Brands
        $categoriesData = Category::where('status', 1)
            ->whereHas('brands', function ($q) {
                $q->where('status', 1);
            })
            ->with(['brands' => function ($q) {
                $q->where('status', 1);
            }])
            ->get();

        // Latest updates only category 10 & 11
        $latestUpdates = DescriptionPage::where('status', 1)
            ->whereIn('category_id', [10, 11])
            ->whereBetween('created_at', [
                Carbon::now()->subMonth(),
                Carbon::now()
            ])
            ->latest()
            ->get();

        // Separate
        $governmentJobs = $latestUpdates->where('category_id', 10);
        $privateJobs = $latestUpdates->where('category_id', 11);

        // Tabs Category Logic
        $categoriesForTabs = Category::whereIn('id', [10, 11])
            ->with('subcategories')
            ->get();

        // Attach subcategory-wise pages
        foreach ($categoriesForTabs as $cat) {
            foreach ($cat->subcategories as $sub) {
                $sub->pages = DescriptionPage::whereRaw("FIND_IN_SET(?, subcategory_id)", [$sub->id])
                    ->where('status', 1)
                    ->latest()
                    ->get();
            }
        }

        // FINAL RETURN (only one)
        return view('front.pages.home', compact(
            'categories',
            'educations',
            'jobStates',
            'jobBrands',
            'categoriesData',
            'governmentJobs',
            'privateJobs',
            'latestUpdates',
            'categoriesForTabs'
        ));
    }


    public function categoryPages($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // load subcategories with active pages (limit 15 per subcategory)
        $subcategories = Subcategory::where('category_id', $category->id)
            ->get()
            ->map(function ($sub) {
                // load pages manually using FIND_IN_SET and limit 15
                $sub->pages = DescriptionPage::where('status', 1)
                    ->whereRaw("FIND_IN_SET(?, subcategory_id)", [$sub->id])
                    ->latest()        // optional: get latest first
                    ->take(15)        // limit 15
                    ->get();
                return $sub;
            });

        return view('front.pages.category', compact('category', 'subcategories'));
    }

    public function subcategoryPages($slug)
    {

        if ($slug == 'test-series') {

            $tests = Test::with('exam')
    ->where('status', 'active')
    ->get(); 
 
            return view('front.pages.allTest', compact('tests'));
        }
        // dd($slug);
        // Find subcategory by slug
        $subcategory = Subcategory::where('slug', $slug)->firstOrFail();

        // Get all active pages for this subcategory
        $pages = DescriptionPage::where('status', 1)
            ->whereRaw("FIND_IN_SET(?, subcategory_id)", [$subcategory->id])
            ->latest()
            ->get();

        return view('front.pages.subcategory', compact('subcategory', 'pages'));
    }



    public function descriptionPage($slug)
    {

        $desciption = DescriptionPage::where('slug', $slug)->firstOrFail();

        return view('front.pages.descriptionDetailsPage', [
            'desciption' => $desciption,
            'meta_title' => $desciption->meta_title ?? $desciption->title,
            'meta_description' => $desciption->meta_description ?? Str::limit(strip_tags($desciption->content), 150),
            'meta_keywords' => $desciption->meta_keywords ?? 'jobs, rojgarvala, latest jobs',
            'meta_image' => asset('front/images/comlogo.webp'),
        ]);

        // return view('front.pages.descriptionDetailsPage', compact('desciption'));
    }
    public function showPage($slug)
    {
        $result = WebsitePage::where('slug', $slug)->firstOrFail();
        return view('front.pages.pageDetails', compact('result'));
    }


    public function latestUpdates($str)
    {
        // Use PHP 8+ match expression
        $latestUpdates = match ($str) {

            // If slug is latest-updates → show last 1 month data
            'latest-updates' => DescriptionPage::where('status', 1)
                ->whereBetween('created_at', [
                    Carbon::now()->subMonth(),
                    Carbon::now()
                ])
                ->latest()
                ->get(),

            // Default → show all active data
            default => DescriptionPage::where('status', 1)
                ->latest()
                ->get(),
        };
        $pageName = "All Letest Update";

        return view('front.pages.allexamdata', compact('latestUpdates', 'pageName'));
    }


    public function stateWiseList($id)
    {
        $state = State::where('id', $id)->firstOrFail();

        // Fetch data where the selected state exists in CSV field
        $latestUpdates = DescriptionPage::where('status', 1)
            ->whereRaw("FIND_IN_SET(?, state)", [$state->name])
            ->get();

        $pageName = "State Wise Job";

        return view('front.pages.allexamdata', compact('latestUpdates', 'pageName'));
    }

    public function educationWise($id)
    {


        $educations = EducationJob::where('id', $id)->firstOrFail();

        // Fetch data where the selected state exists in CSV field
        $latestUpdates = DescriptionPage::where('status', 1)
            ->whereRaw("FIND_IN_SET(?, eligibility)", [$educations->title])
            ->get();
        // dd($latestUpdates);
        $pageName = "Education Wise Job";

        return view('front.pages.allexamdata', compact('latestUpdates', 'pageName'));
    }

    public function showBrand($brandName)
    {
        // Fetch data where the selected state exists in CSV field
        $latestUpdates = DescriptionPage::where('status', 1)
            ->whereRaw("FIND_IN_SET(?, jobbrand)", [$brandName])
            ->get();
        // dd($latestUpdates);
        $pageName = "Organization Wise Job";

        return view('front.pages.allexamdata', compact('latestUpdates', 'pageName'));
    }

    public function contact()
    {
        return view('front.pages.contact');
    }



    public function jobs()
    {
        return view('front.pages.jobs');
    }
}
