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
Route::get('/user/all', [AuthController::class, 'getAllUsers']);
Route::get('/user/no-room', [AuthController::class, 'getUserWithoutRoom']);


//Device Route
Route::prefix('devices')->group(function () {
    Route::get('/{device}', [DeviceController::class, 'getDeviceStatus']);
    Route::post('/{device}/room/{roomId}/status/{status}', [DeviceController::class, 'handleDevice']);
});




//Building Service
Route::post('/building/create', [BuildingController::class, 'createBuilding']);

//Room
Route::prefix('room')->group(function () {
    Route::post('/create', [\App\Http\Controllers\RoomController::class, 'createRoom']);
    Route::put('/{roomId}', [\App\Http\Controllers\RoomController::class, 'updateRoom']);
    Route::delete('/{roomId}/remove-device/{deviceId}', [\App\Http\Controllers\RoomController::class, 'deleteRoomDevice']);
    Route::delete('/{roomId}', [\App\Http\Controllers\RoomController::class, 'deleteRoom']);
    Route::get('/all', [\App\Http\Controllers\RoomController::class, 'getAllRoom']);
    Route::get('/{roomId}', [\App\Http\Controllers\RoomController::class, 'getRoom']);
    Route::post('/{roomId}/add-device', [\App\Http\Controllers\RoomController::class, 'addRoomDevice']);
    Route::post('/{userId}/add', [\App\Http\Controllers\RoomController::class, 'addRoomAndOwner']);
});
