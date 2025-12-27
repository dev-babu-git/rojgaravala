<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
    public function handle($request, Closure $next, ...$roles)
    {

       
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login first.');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Access denied!');
        }

        if (Auth::user()->session_id !== Session::getId()) {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Session expired, login again.');
        }

        return $next($request);
    }
}


