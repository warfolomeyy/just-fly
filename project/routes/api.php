<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('api-flight')->group(function () {
    Route::post('/signup', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/products', [ProductController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::patch('/profile', [AuthController::class, 'updateProfile']);
        Route::get('/logout', [AuthController::class, 'logout']);

        Route::get('/cart', [CartController::class, 'index']);
        Route::post('/cart/{product}', [CartController::class, 'store']);
        Route::delete('/cart/{cart}', [CartController::class, 'destroy']);

        Route::get('/order', [OrderController::class, 'index']);
        Route::post('/order', [OrderController::class, 'store']);

        Route::middleware('admin')->group(function () {
            Route::post('/product', [ProductController::class, 'store']);
            Route::patch('/product/{product}', [ProductController::class, 'update']);
            Route::delete('/product/{product}', [ProductController::class, 'destroy']);
        });
    });
});
