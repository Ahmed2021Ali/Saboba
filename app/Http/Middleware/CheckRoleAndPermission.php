<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckRoleAndPermission
{
    public function handle($request, Closure $next, $role, $permissions)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            throw UnauthorizedException::notLoggedIn();
        }

        // Check if the user has the specified role
        if (!$user->hasRole($role)) {
            throw UnauthorizedException::forPermissions([$role]);
        }

        // Check if the user has any of the specified permissions
        $permissionsArray = is_array($permissions) ? $permissions : explode('|', $permissions);

        if (!$user->hasAnyPermission($permissionsArray)) {
            throw UnauthorizedException::forPermissions($permissionsArray);
        }

        return $next($request);
    }
}
