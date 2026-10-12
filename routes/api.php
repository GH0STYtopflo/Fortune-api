<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FortuneUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/users/fortunes:random', [FortuneUserController::class, 'random']);

    Route::get('/users/{user}/fortunes', [FortuneUserController::class, 'list']);

    Route::get('/users/{user}/fortunes/{fortune}', [FortuneUserController::class, 'get']);

    Route::delete('/users/{user}/fortunes/{fortune}', [FortuneUserController::class, 'detach']);
});
