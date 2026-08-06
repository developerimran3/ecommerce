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


            if (Auth::user()->status == 0) {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Your account is inactive. Contact administrator.'
                    );
            }
        }



        return $next($request);
    }
}
