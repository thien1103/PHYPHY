<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrackBillController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/track-bills', [TrackBillController::class, 'store']);

// Test route để kiểm tra API hoạt động
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
