<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSingleSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::check()) {
            
            $user = Auth::user();
 
            // If session doesn't match → logout user
            if ($user->session_id !== Session::getId()) {
                Auth::logout();
                return redirect()->route('admin.login')
                    ->with('error', 'Your account logged in on another device.');
            }
        }

        return $next($request);
    }
}
