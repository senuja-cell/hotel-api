<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GuestController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Hotel REST API Resources
Route::apiResource('rooms', RoomController::class);
Route::apiResource('reservations', ReservationController::class);
Route::apiResource('guests', GuestController::class);
