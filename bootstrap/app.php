<?php

use App\Domain\Auth\Middlewares\AuthMiddleware;
use App\Domain\Auth\Middlewares\EmailVerifiedMiddleware;
use App\Domain\Auth\Middlewares\GuestMiddleware;
use App\Domain\Auth\Middlewares\TwoFactorMiddleware;
use App\Panel\Middleware\SetPanelMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__.'/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'guest' => GuestMiddleware::class,
            'auth' => AuthMiddleware::class,
            'verified' => EmailVerifiedMiddleware::class,
            'two-factor' => TwoFactorMiddleware::class,
            'panel' => SetPanelMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
