<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // If the user is not authenticated, redirect to the login form
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('login.form')->with('error', 'عفوا! انت غير مسجل دخول');
        }
        // If authenticated, proceed with the request
        return $next($request);

    }
}
