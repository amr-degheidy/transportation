<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::group(['prefix'=>'dashboard' ,'as' => 'dashboard.'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/',[DashboardController::class, 'index'])->name('index');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

