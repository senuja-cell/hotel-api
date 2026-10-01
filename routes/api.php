<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GuestController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Operational Check-In and Check-Out actions
Route::post('check-in', [RoomController::class, 'checkIn']);
Route::post('check-out', [RoomController::class, 'checkOut']);

// Hotel REST API Resources
Route::apiResource('rooms', RoomController::class);
Route::apiResource('reservations', ReservationController::class);
Route::apiResource('guests', GuestController::class);
