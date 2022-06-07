<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\CategoryController;


Route::apiResource('api-products', ProductController::class)->only(['index', 'show']);
Route::apiResource('api-categories', CategoryController::class)->only(['index', 'show']);


Route::apiResource('api-orders', ApiOrderController::class)->only(['index', 'show', 'store']);

//API route for register new user
Route::post('/register', [AuthController::class, 'register']);

//API route for login user
Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});
