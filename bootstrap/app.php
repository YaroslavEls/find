<?php

use App\Http\Middleware\EnsureUserIsCompleted;
use App\Http\Middleware\EnsureUserIsIncompleted;
use App\Http\Middleware\EnsureUserIsSaloon;
use App\Http\Middleware\EnsureUserIsSeeker;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
            'completed' => EnsureUserIsCompleted::class,
            'incompleted' => EnsureUserIsIncompleted::class,
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
        $exceptions->render(function (HttpException $e, Request $request) {
            return Inertia::render('Error' ,[
                'code' => $e->getStatusCode()
            ])
            ->toResponse($request)
            ->setStatusCode($e->getStatusCode());
        });
    })->create();
