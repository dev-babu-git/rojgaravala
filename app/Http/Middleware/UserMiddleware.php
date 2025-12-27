<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('users.login');
        }

        if (Auth::user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
