<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if 'age' parameter is passed and greater than or equal to 18
        if ($request->input('age') && $request->input('age') < 18) {
            // If the user is not old enough, redirect to a specific route
            return response('restricted', 400);
        }

        // If the age is valid, proceed with the request
        return $next($request);
    }
}
