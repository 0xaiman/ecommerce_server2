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
});



//apuResource
Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);


Route::middleware('auth:sanctum')->prefix('products')->group(function () {
    Route::post('show', [ProductController::class, 'show']);
    Route::post('index', [ProductController::class, 'index']);
});
Route::middleware('auth:sanctum')->prefix('categories')->group(function () {
    Route::post('show', [CategoryController::class, 'show']);
    Route::post('index', [CategoryController::class, 'index']);
});


Route::middleware('auth:sanctum')->prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'show']);
    Route::post('add', [CartController::class, 'add']);
    Route::delete('item/{itemId}', [CartController::class, 'remove']);
    Route::delete('clear', [CartController::class, 'clear']);

    //Example postman requets to test
    //GET http://localhost:8000/api/cart
    //POST http://localhost:8000/api/cart/add
    //DELETE http://localhost:8000/api/cart/item/{itemId}
    //DELETE http://localhost:8000/api/cart/clear

    //add cart example payload
    //{
    //    "product_id": 1,
    //    "quantity": 1
    //}
});