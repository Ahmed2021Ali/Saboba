<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Guard;

class RoleOrPermissionMiddleware
{
    public function handle($request, Closure $next, $roleOrPermission, $guard = null)
    {
        $authGuard = Auth::guard($guard);
        $user = $authGuard->user();

        // For machine-to-machine Passport clients
        if (!$user && $request->bearerToken() && config('permission.use_passport_client_credentials')) {
            $user = Guard::getPassportClient($guard);
        }

        // Check if the user is authenticated
        if (!$user) {
            throw UnauthorizedException::notLoggedIn();
        }

        // Ensure the user has the necessary methods
        if (!method_exists($user, 'hasAnyRole') || !method_exists($user, 'hasAnyPermission')) {
            throw UnauthorizedException::missingTraitHasRoles($user);
        }

        // Split roles and permissions from the input string
        $rolesOrPermissions = is_array($roleOrPermission) 
            ? $roleOrPermission 
            : explode('|', $roleOrPermission);

        // Check for roles or permissions
        if (!$user->hasAnyRole($rolesOrPermissions) && !$user->canAny($rolesOrPermissions)) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }

        return $next($request);
    }

    /**
     * Specify the role or permission and guard for the middleware.
     *
     * @param  array|string  $roleOrPermission
     * @param  string|null  $guard
     * @return string
     */
    public static function using($roleOrPermission, $guard = null)
    {
        $roleOrPermissionString = is_string($roleOrPermission) ? $roleOrPermission : implode('|', $roleOrPermission);
        $args = is_null($guard) ? $roleOrPermissionString : "$roleOrPermissionString,$guard";

        return static::class.':'.$args;
    }
}
