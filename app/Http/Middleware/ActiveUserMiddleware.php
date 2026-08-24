<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        if (!$user->status) {

            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->is('admin/*')) {
                return redirect()
                    ->route('admin.login')
                    ->with('error', 'Your account is temporarily disabled. Contact Administrator.');
            }

            return redirect()
                ->route('customer.login')
                ->with('error', 'Your account is temporarily disabled. Contact Administrator.');
        }

        return $next($request);
    }
}
