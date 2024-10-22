<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {

        if (Auth::user() && Auth::user()->role !== $role) {
            return response()->json(['error' => 'عفوا انت لا تملك الصلاحية لأنك لست' . $role], 403);
        }

        // Check if the user is not authenticated
        if (!Auth::check()) {
            return redirect('/')->withErrors(['error' => 'يرجى تسجيل الدخول أولاً']);
        }

        // Check if the user does not have the required role
        if (Auth::user()->role !== $role) {
            return redirect()->back()->withErrors(['error' => 'عفواً، انت لا تملك الصلاحية لأنك لست ' . $role]);
        }
        return $next($request);
    }

}
