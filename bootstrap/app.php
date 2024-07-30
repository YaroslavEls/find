<?php

use App\Http\Middleware\EnsureUserIsSaloon;
use App\Http\Middleware\EnsureUserIsSeeker;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

// use Illuminate\Routing\Exceptions\InvalidSignatureException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'seeker' => EnsureUserIsSeeker::class,
            'saloon' => EnsureUserIsSaloon::class
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if (str_starts_with($request->path(), 'seekers')) {
                return route('login', ['type' => 1]);
            }
            return route('login', ['type' => 0]);
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function (InvalidSignatureException $e) {
        //     return redirect(route('home'));
        // });
    })->create();
