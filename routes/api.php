<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

//auth route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);



//protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/products', [ProductController::class, 'index']);
    
    Route::get('/order', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
    
});