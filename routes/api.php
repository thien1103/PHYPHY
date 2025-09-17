<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrackBillController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupClientController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//Track bills
Route::post('/track-bills', [TrackBillController::class, 'store']);

// Warehouse
Route::get('/warehouses', [WarehouseController::class, 'warehouses']);
Route::get('/warehouse-management', [WarehouseController::class, 'warehouseManagement']);

// User
Route::get('/staffs', [UserController::class, 'staffs']);

// Group Client
Route::get('/group-clients', [GroupClientController::class, 'index']);


