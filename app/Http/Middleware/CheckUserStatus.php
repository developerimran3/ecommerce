<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {

            $user = Auth::user();

            // Inactive user check
            if ($user->status == 0) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                // Customer হলে Customer Login page
                if ($user->role === 'Customer') {
                    return redirect()
                        ->route('customer.login')
                        ->with(
                            'error',
                            'Your account is temporarily disabled. Contact Administrator.'
                        );
                }
                // Customer ছাড়া অন্য role হলে Home page
                return redirect()
                    ->route('admin.login')
                    ->with(
                        'error',
                        'Your account is temporarily disabled. Contact Administrator.'
                    );
            }
        }
        return $next($request);
    }
}
