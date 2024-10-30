<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;

/*
// Ruta de ejemplo protegida
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('auth/register', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::resource('cities',CityController::class);
    Route::resource('events',EventController::class);
    Route::get('eventsall',[EventController::class,'all']);
    Route::get('eventsbycity',[EventController::class,'EventsByCity']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});
