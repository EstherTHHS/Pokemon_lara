<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResource('/product', ProductController::class);
    Route::delete('/delete-image/product/{id}', [ProductController::class, 'deleteProductImage']);
    Route::get('/status/product/{id}', [ProductController::class, 'productStatus']);
    Route::post('/payment', [PaymentController::class, 'store']);
});


Route::post('/login', [AuthController::class, 'login']);
