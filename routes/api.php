<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/api/v1/register', [AuthController::class, 'register']);
Route::post('/api/v1/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/v1/me', [AuthController::class, 'me']);
    Route::post('/api/v1/logout', [AuthController::class, 'logout']);
});
