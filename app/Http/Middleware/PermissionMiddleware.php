<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {

        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Administrator has full access
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'Administrator') {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | Check user permission
        |--------------------------------------------------------------------------
        */

        if (
            method_exists($user, 'hasPermission') &&
            $user->hasPermission($permission)
        ) {
            return $next($request);
        }

        abort(403, 'You do not have this permission.');
    }
}
