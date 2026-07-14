<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        $middleware->redirectUsersTo(function ($request) {
            $user = $request->user();
            if ($user) {
                switch ($user->role) {
                    case 'pengguna':
                        return route('dashboard');
                    case 'kasubbag':
                        return route('kasubbag');
                    case 'solver':
                        return route('solver');
                    case 'operator':
                        return route('operator');
                }
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
