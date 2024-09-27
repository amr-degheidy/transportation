<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/{pathMatch}', function(){
   return view('index');
})->where('pathMatch', '.*');
