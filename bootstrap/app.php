<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Domain\Auth\Middlewares\AuthMiddleware;
use App\Domain\Auth\Middlewares\EmailVerifiedMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */
    ->withRouting(
        channels: __DIR__ . '/../routes/channels.php',
        web      : __DIR__ . '/../routes/web.php',
        commands : __DIR__ . '/../routes/console.php',
        health   : '/up',
    )

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    */
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth'        => AuthMiddleware::class,
            'verified'    => EmailVerifiedMiddleware::class,
        ]);
    })

    /*
    |--------------------------------------------------------------------------
    | Exceptions
    |--------------------------------------------------------------------------
    */
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();