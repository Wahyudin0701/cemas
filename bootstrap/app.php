<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'redirectHome' => \App\Http\Middleware\RedirectHomeByRole::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'check.status' => \App\Http\Middleware\CheckUserStatus::class,
        ]);
        
        // Apply check.status to web group automatically if desired, 
        // or just ensure we use it in routes.
        // For now, let's append it to the web group to be safe globally for web routes.
        $middleware->appendToGroup('web', \App\Http\Middleware\CheckUserStatus::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
