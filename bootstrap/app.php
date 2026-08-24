<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\ActiveUserMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\PermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Middleware Aliases
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'customer' => CustomerMiddleware::class,
            'active' => ActiveUserMiddleware::class,
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Guest Redirect
        |--------------------------------------------------------------------------
        */

        $middleware->redirectGuestsTo(function ($request) {

            /*
            |--------------------------------------------------------------------------
            | Admin Guest
            |--------------------------------------------------------------------------
            */

            if (
                $request->is('admin') ||
                $request->is('admin/*')
            ) {
                return route('admin.login');
            }


            /*
            |--------------------------------------------------------------------------
            | Customer Guest
            |--------------------------------------------------------------------------
            */

            return route('customer.login');
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
