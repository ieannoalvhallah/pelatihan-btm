<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/barangs', fn () => redirect()->route('dashboard'));
    Route::post('/barangs', [DashboardController::class, 'storeBarang'])
        ->name('barangs.store.web');

    Route::get('/kategoris', fn () => redirect()->route('dashboard'));
    Route::post('/kategoris', [DashboardController::class, 'storeKategori'])
        ->name('kategoris.store.web');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});

Route::fallback(function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});
