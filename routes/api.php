<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\RegisteredEmployeeController;

// // Employee registration / CRUD (Protected)
// Route::apiResource('employees', RegisteredEmployeeController::class)->middleware('auth:sanctum');

// Login (Public)
Route::post('/login', [AuthController::class, 'login']);

// Current logged in user (Protected)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
