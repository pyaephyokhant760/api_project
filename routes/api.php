<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\BusinessController;


Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::apiResource("user", UserController::class);


Route::middleware('auth:sanctum')->group(function() {

    Route::group(['middleware' => 'adminMiddleware'],function() {
        Route::apiResource("service", ServiceController::class);
        Route::apiResource("booking", BookingController::class);
    });

    Route::group(['middleware' => 'userMiddleware'],function() {
        Route::apiResource("business", BusinessController::class);
        Route::apiResource("review", ReviewController::class);
    });
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
