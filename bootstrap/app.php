<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'event.owner' => \App\Http\Middleware\EventOwner::class,
            'reservation.owner' => \App\Http\Middleware\ReservationOwner::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized Access, You do not have the required permission',
                'status'  => 403,
            ], 403);
        });
        $exceptions->render(function (ThrottleRequestsException $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Too many attempt, Please try again after a few minutes',
                'status'  => 429,
            ], 429);
        });
        $exceptions->render(function (NotFoundHttpException  $e, $request) {
            return response()->json([
                'success' => false,
                'message' => 'Not Found',
            ], 404);
        });
    })->create();
