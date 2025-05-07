<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\admin\UsersController;

Route::get('/', function () {
    return redirect('/login');
})->name('home');

Route::get('/api-docs', function () {
    return view('api_endpoints');
});

// Middleware de autenticação
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Controllers\admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/reservations', [Controllers\admin\ReservationsController::class, 'index'])->name('admin.reservations');
    Route::get('/users', [Controllers\admin\UsersController::class, 'index'])->name('admin.users');
    Route::delete('/users/delete/{user}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/rooms', [Controllers\admin\RoomsController::class, 'index'])->name('admin.rooms');
});

// Rotas de login/logout
Route::post('/login', [Controllers\AuthController::class, 'login']);
Route::match(['get', 'post'], '/logout', [Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Rotas de criação de usuário
Route::get('/admin/users/create', [UsersController::class, 'createAdmin'])->name('admin.users.create');
Route::post('/admin/users', [UsersController::class, 'storeAdmin'])->name('admin.users.store');

// Resto das rotas...
require __DIR__.'/auth.php';
