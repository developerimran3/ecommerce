<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('customer.login');
        }

        if (auth()->user()->role !== 'Customer') {
            abort(403, 'Customer access only.');
        }

        return $next($request);
    }
}
