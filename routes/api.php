<?php

use App\Http\Controllers\BarberController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('barbers', [BarberController::class, 'index'])->name('barbers.index');
Route::post('barbers', [BarberController::class, 'store'])->name('barbers.store');
Route::delete('barbers', [BarberController::class, 'destroy'])->name('barbers.destroy');

Route::get('appointments');
Route::post('appointments');
Route::delete('appointments');