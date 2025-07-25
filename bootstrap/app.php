<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        then: function () {
            Route::group([
                'as' => 'passport.',
                'prefix' => config('passport.path', 'oauth'),
                'namespace' => 'Laravel\Passport\Http\Controllers',
            ], function () {
                require __DIR__.'/../vendor/laravel/passport/routes/web.php';
            });
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\EncryptCookies::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\AuthGates::class,
            \App\Http\Middleware\SetLocale::class,
        ]);

        $middleware->api(prepend: [
            \App\Http\Middleware\AuthGates::class,
        ]);

        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
