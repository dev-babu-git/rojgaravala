<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
 


        if (!Auth::guard('user')->check()) {
            return redirect()->route('users.login')
                ->with('error', 'Please login first.');
        }

        return $next($request);
    }
}
