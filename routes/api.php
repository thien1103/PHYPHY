<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Test route để kiểm tra API hoạt động
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
