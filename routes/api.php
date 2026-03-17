<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/categories', \App\Http\Controllers\Api\CategoryController::class);
Route::get('/products', \App\Http\Controllers\Api\ProductController::class);
Route::apiResource('orders', \App\Http\Controllers\Api\OrderController::class);

