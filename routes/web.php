<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\admin\ReservationsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\RoomsController;
use App\Http\Controllers\admin\DashboardController;

// Redireciona home para login
Route::get('/', fn() => redirect('/login'))->name('home');
Route::get('/api-docs', fn() => view('api_endpoints'));

// Rotas que precisam estar logadas
Route::middleware('auth')
    ->prefix('dashboard')      // prefixo de URL: /dashboard/...
    ->name('admin.')           // prefixo de nome: admin.*
    ->group(function () {
        // GET /dashboard          → admin.dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // GET /dashboard/reservations  → admin.reservations
        Route::get('/reservations', [ReservationsController::class, 'index'])->name('reservations');
        // DELETE /dashboard/reservations/{reservation} → admin.reservations.destroy
        Route::delete('/reservations/{reservation}', [ReservationsController::class, 'destroy'])->name('reservations.destroy');

        // GET /dashboard/users     → admin.users
        Route::get('/users', [UsersController::class, 'index'])->name('users');
        // GET /dashboard/users/create  → admin.users.create
        Route::get('/users/create', [UsersController::class, 'createAdmin'])->name('users.create');
        // POST /dashboard/users    → admin.users.store
        Route::post('/users', [UsersController::class, 'storeAdmin'])->name('users.store');
        // DELETE /dashboard/users/{user} → admin.users.destroy
        Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

        // GET /dashboard/rooms     → admin.rooms
        Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
        // POST /dashboard/rooms    → admin.rooms.store
        Route::post('/rooms', [RoomsController::class, 'store'])->name('rooms.store');
        // DELETE /dashboard/rooms/{room} → admin.rooms.destroy
        Route::delete('/rooms/{room}', [RoomsController::class, 'destroy'])->name('rooms.destroy');
    });

// Logout (sessão web)
Route::match(['get','post'], '/logout', [Controllers\AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rotas de autenticação padrão (login/register) ficam em auth.php
require __DIR__.'/auth.php';
