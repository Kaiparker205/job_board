<?php

use App\Http\Middleware\HasCompany;
use App\Http\Middleware\onlyAdmin;
use App\Http\Middleware\OnlyEmployeur;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Employeur' => OnlyEmployeur::class,
            'CheckCompany'=>HasCompany::class,
            'admin'=>onlyAdmin::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
