<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventTypeController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('locations', LocationController::class);

    Route::apiResource('event_types', EventTypeController::class);

    Route::apiResource('events', EventController::class);
    Route::get('user/events', [EventController::class, 'usersEvents']);

    Route::apiResource('reservations', ReservationController::class);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,5');
