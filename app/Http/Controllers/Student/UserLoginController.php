<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class UserLoginController extends Controller
{
    // Show login page
    public function loginPage()
    {

        return view('front.pages.studentLogin');
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

    public function registerPage()
    {
        return view('front.pages.studentRegister'); // view file path
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // 1️⃣ Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // 2️⃣ Generate dynamic enrollment number and encrypt it
        $dynamicEnrollment = 'ENR' . strtoupper(Str::random(6));
        $encryptedEnrollment = Crypt::encryptString($dynamicEnrollment);

        // 3️⃣ Create Student Info
        Student::create([
            'user_id' => $user->id,
            'enrollment_no' => $encryptedEnrollment,
        ]);
        return redirect()->route('users.login')
            ->with('success', 'Registration successful! Your Enrollment No is: ' . $dynamicEnrollment)
            ->with('email', $request->email)           // flash email
            ->with('password', $request->password);
    }
}
