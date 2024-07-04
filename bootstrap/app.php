<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => 'Record Not Found'
                ], 404);
            }
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => 'The specified method is not valid for this request.'
                ], 405);
            }
        });

        $exceptions->render(function (AuthenticationException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => 'Unauthenticated'
                ], 401);
            }
        });

        $exceptions->render(function (QueryException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => env('APP_DEBUG') ? $e->getMessage() : 'Database Connection lost'
                ], 500);
            }
        });

        $exceptions->render(function (HttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => 'Internal Server Error'
                ], 500);
            }
        });

        $exceptions->render(function (ValidationException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 400);
            }
        });
    })->create();
