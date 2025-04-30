<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return redirect('/login');
})->name('home');


Route::get('/api-docs', function () {
    return view('api_endpoints');
});
    

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/reservations', [Controllers\admin\ReservationsController::class, 'index'])->name('admin.reservations');
    Route::get('/users', [Controllers\admin\UsersController::class, 'index'])->name('admin.users');
    Route::get('/rooms', [Controllers\admin\RoomsController::class, 'index'])->name('admin.rooms');
});

Route::post('/login', [Controllers\AuthController::class, 'login']);
Route::match(['get', 'post'], '/logout', [Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Route::post('/register', [AuthController::class, 'register']);


require __DIR__.'/auth.php';
