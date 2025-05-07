<?php

use App\Http\Controllers\Api\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('v1/me', [AuthController::class, 'me']);
    Route::post('v1/logout', [AuthController::class, 'logout']);
});

Route::get('v1/rooms', [RoomController::class, 'index']);
