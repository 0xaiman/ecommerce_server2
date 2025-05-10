<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//group api with prefix products , every route is post request, product/index, product/create, product/update, product/delete
Route::group(['prefix' => 'product'], function () {
    Route::post('/index', [ProductController::class, 'index']);
    Route::post('/show', [ProductController::class, 'show']);
    Route::post('/create', [ProductController::class, 'store']);
    Route::post('/update', [ProductController::class, 'update']);
    Route::post('/delete', [ProductController::class, 'destroy']);
});
