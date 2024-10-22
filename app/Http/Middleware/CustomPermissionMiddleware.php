<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CustomPermissionMiddleware
{
    public function handle($request, Closure $next, $permissions)
    {
        // Get the current user
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            throw UnauthorizedException::notLoggedIn();
        }

        // Get the array of permissions
        $permissionsArray = is_array($permissions) ? $permissions : explode('|', $permissions);

        // Check if the user has any of the specified permissions
        if (!$user->hasAnyPermission($permissionsArray)) {
            // Optionally log unauthorized access or customize the exception message
            throw UnauthorizedException::forPermissions($permissionsArray);
        }

        return $next($request);
    }
}
