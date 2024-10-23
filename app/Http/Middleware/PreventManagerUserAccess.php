<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class PreventManagerUserAccess
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
        // Retrieve the user ID from the route (ensure the route has 'user' as a parameter)
        $userId = $request->route('user');

        // Ensure that user ID is provided and valid
        if ($userId) {
            // Find the user by ID
            $user = User::find($userId);

            // Check if the user exists
            if ($user) {
                // Check if the authenticated user is the specific manager
                if (auth()->user()->email === 'mahmoudawaga@gmail.com' && auth()->user()->hasRole('manager')) {
                    // Allow the manager to view all users and to edit/delete others
                    // But prevent them from editing or deleting themselves
                    if (auth()->id() === $user->id) {
                        // Prevent the manager from editing or deleting their own profile
                        if ($request->isMethod('put') || $request->isMethod('delete')) {
                            return abort(403, 'لا يمكنك تعديل أو حذف حسابك الخاص.');
                        }
                    }
                    // Allow all other operations for the manager
                    return $next($request);
                } else {
                    // Prevent any other user from accessing the manager's profile
                    if ($user->email === 'mahmoudawaga@gmail.com') {
                        return abort(403, 'لا يمكنك الوصول إلى بيانات هذا المستخدم.');
                    }
                }
            }
        }

        return $next($request);
    }
}
