<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    // Show login page
    public function loginPage()
    {
        return view('usersPage.pages.usersLogin');
    }

    // Handle login form submit
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if ($user->role !== 'user') {
                Auth::logout();
                return back()->with('error', 'You are not allowed to login here.');
            }

            // ✅ Save session
            $user->session_id = session()->getId();
            $user->save();

            return redirect()->route('users.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users.login')->with('success', 'Logged out successfully.');
    }
}
