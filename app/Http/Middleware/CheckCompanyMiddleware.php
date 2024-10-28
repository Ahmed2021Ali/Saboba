<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->type === 'company') {
            return response()->json(['error' => 'Your Not Company'], 401);
        }
        return $next($request);
    }
}
