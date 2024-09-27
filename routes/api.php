<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::group(['prefix'=>'dashboard'], function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/',[DashboardController::class, 'index']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

