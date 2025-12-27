<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\DescriptionPage;
use App\Models\EducationJob;
use App\Models\JobBrand;
use App\Models\State;
use App\Models\User;
use App\Models\WebsitePage;




class AdminAuthController extends Controller
{
    public function index()
    {

        $totalCategories = Category::where('status',1)->count();
        $totalSubcategories = Subcategory::where('status',1)->count();
        $totalDescriptionPages = DescriptionPage::where('status',1)->count();
        $totalStates = State::where('status',1)->count();
        $totalEducationJobs = EducationJob::where('status',1)->count();
        $totalJobBrands = JobBrand::where('status',1)->count();
        $totalUsers = User::count();
        $totalWebsitePages = WebsitePage::where('status',1)->count();

        return view('admin.pages.index', compact(
            'totalCategories',
            'totalSubcategories',
            'totalDescriptionPages',
            'totalStates',
            'totalEducationJobs',
            'totalJobBrands',
            'totalUsers',
            'totalWebsitePages'
        ));
    }

    public function loginPage()
    {
        return view('admin.pages.adminLogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role == 'admin' || Auth::user()->role == 'saysadmin') {

                $currentSession = Session::getId();
                $user = Auth::user();

                if ($user->session_id && $user->session_id !== $currentSession) {
                    DB::table('sessions')->where('id', $user->session_id)->delete();
                }

                $user->session_id = $currentSession;
                $user->save();

                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->with('error', 'Access denied!');
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        $user = Auth::user();

        // Clear stored session_id to prevent session reuse
        if ($user) {
            $user->session_id = null;
            $user->save();
        }

        Auth::logout();               // logout user
        Session::flush();             // clear all session data
        Session::invalidate();        // invalidate session
        Session::regenerateToken();   // regenerate CSRF token

        return redirect()->route('admin.login')->with('success', 'Logout Successful');
    }
}
