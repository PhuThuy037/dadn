<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});
// Các route không cần xác thực
Route::middleware('guest')->group(function () {
    // Hiển thị form đăng nhập
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    
    // Xử lý đăng nhập
    Route::post('/login', [AuthController::class, 'login']);
});

// Các route yêu cầu xác thực
Route::middleware('auth')->group(function () {
    // Trang chủ sau khi đăng nhập
    Route::get('/home', [AuthController::class, 'home'])->name('home');
    
    // Đăng xuất
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
