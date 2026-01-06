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
use App\Models\TestAttempt;
use App\Models\Test;

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


            if (session()->has('pending_attempt_id')) {

                TestAttempt::where('id', session('pending_attempt_id'))
                    ->update([
                        'user_id'         => $user->id,
                        'attempt_user_id' => $user->id,
                    ]);

                session()->forget('pending_attempt_id');
            }

            return redirect()->route('student.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login')->with('success', 'Logged out successfully.');
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

        // 2️⃣ Generate Enrollment Number using created user ID
        $dynamicEnrollment = 'ENR' . str_pad($user->id, 6, '0', STR_PAD_LEFT);

        // 3️⃣ Create Student Info
        Student::create([
            'user_id' => $user->id,
            'enrollment_no' => $dynamicEnrollment,
        ]);

        return redirect()->route('users.login')
            ->with('success', 'Registration successful! Your Enrollment No is: ' . $dynamicEnrollment)
            ->with('email', $request->email)
            ->with('password', $request->password);
    }


    // Login to attempt test
    public function loginToAttempt(Test $test)
    {
        
        // agar already attempt exist karta ho (guest ke liye)
        $attempt = TestAttempt::create([
            'user_id'         => null,           // guest
            'test_id'         => $test->id,
            'attempt_user_id' => null,           // login ke baad fill hoga
            'status'          => 'started',
            'started_at'      => now(),
        ]);



        // attempt id session me save
        session(['pending_attempt_id' => $attempt->id]);

        return redirect()->route('student.login');
    }
}
