<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('auth.register');
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/logout', 'logout')->name('auth.logout')->middleware('auth:sanctum');
});

// Todo Routes
Route::apiResource('todos', TodoController::class)->middleware('auth:sanctum');
