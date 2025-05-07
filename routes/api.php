<?php

use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as ApiAuth;


Route::prefix('v1')->group(function(){
    Route::post('register', [ApiAuth::class,'register']);
    Route::post('login',    [ApiAuth::class,'login']);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('me',        [ApiAuth::class,'me']);
        Route::post('logout',   [ApiAuth::class,'logout']);

        Route::get('rooms',         [RoomController::class,'index']);
        Route::post('reservations', [ReservationController::class,'store']);
    });
});