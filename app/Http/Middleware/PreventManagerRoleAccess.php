<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PreventManagerRoleAccess
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
        // Retrieve the role ID from the route
        $roleId = $request->route('role');

        // Ensure that role ID is provided and valid
        if ($roleId) {
            // Find the role by its ID
            $role = Role::find($roleId);

            // Check if the role is 'manager'
            if ($role && $role->name === 'manager') {
                // Check if the authenticated user is the manager
                if (auth()->user()->email === 'mahmoudawaga@gmail.com' && auth()->user()->hasRole('manager')) {
                    // Allow the manager to view their own role
                    return $next($request);
                } else {
                    // Prevent any other user from accessing the manager role
                    return abort(403, 'لا يمكنك الوصول إلى بيانات دور المدير.');
                }

                // Prevent anyone from updating or deleting the manager role
                if ($request->isMethod('delete') || $request->isMethod('put') || $request->isMethod('patch')) {
                    return abort(403, 'لا يمكنك تعديل أو حذف دور المدير.');
                }
            }
        }

        return $next($request);
    }
}
