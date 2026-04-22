<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'max.auth' => \App\Http\Middleware\MaxAuthenticatedUsers::class,
        ]);

        $middleware->encryptCookies(except: []);

        // CORS para Angular
        $middleware->trustHosts(at: ['localhost:4200']);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();