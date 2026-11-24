<?php

use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('barangs', BarangController::class);
Route::apiResource('kategoris', KategoriController::class);
