<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckPersonalMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->type === 'personal') {
            return response()->json(['error' => 'Your Not Personal'], 401);
        }
        return $next($request);
    }
}
