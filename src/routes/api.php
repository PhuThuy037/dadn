<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\DeviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth rotue
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/user/{user}/update', [AuthController::class, 'updateUser']);

//Device Route
Route::get('/devices/{device}', [DeviceController::class, 'getDeviceStatus']);
Route::post('/devices/{device}/status/{status}', [DeviceController::class, 'handleDevice']);


//Building Service
Route::post('/building/create', [BuildingController::class, 'createBuilding']);

//Room
Route::post('/room/create', [\App\Http\Controllers\RoomController::class, 'createRoom']);
