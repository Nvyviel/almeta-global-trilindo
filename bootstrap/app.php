<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\HandleExpired;
use App\Http\Middleware\HandleNotFound;
use App\Http\Middleware\StatusMiddleware;
use App\Http\Middleware\SessionMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens([
            '/midtrans/callback'
        ]);

        $middleware->alias([
            'session' => SessionMiddleware::class,
            'admin' => AdminMiddleware::class,
            'accessable' => GuestMiddleware::class,
            'status' => StatusMiddleware::class,
            '404' => HandleNotFound::class,
            '419' => HandleExpired::class,
            // '403' => HandleForbidden:class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();

$app->middleware([
    \App\Http\Middleware\UserMiddleware::class,
]);
