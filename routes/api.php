<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //products
    Route::prefix('products')->group(function () {
        Route::post('index', [ProductController::class, 'index']);
        Route::post('show', [ProductController::class, 'show']);
    });

    //carts
    Route::prefix('cart')->group(function () {
        Route::post('index', [CartController::class, 'indexByAuth']);
        Route::post('add-item', [CartController::class, 'addItemToCart']);
        Route::post('clear', [CartController::class, 'clearCart']);
    });
});

