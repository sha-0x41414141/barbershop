<?php

use App\Http\Controllers\BarberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('barbers');
Route::post('barbers');
Route::delete('barbers');

Route::get('appointments');
Route::post('appointments');
Route::delete('appointments');