<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\RegisteredEmployeeController;

Route::get('/', function () {
    return view('employee.auth.login');
        
    
});

// Employee Login Page
Route::get('/employee/login', function () {
    return view('employee.auth.login');
})->name('employee.auth.login');

Route::get('/register', [RegisteredEmployeeController::class, 'create'])
                ->middleware('guest')
                ->name('register');
Route::post('/register', [RegisteredEmployeeController::class, 'store'])

                ->middleware('guest')
                ->name('register.store');
Route::get('/dashboard', function () {
    return view('employee.dashboard');
})->middleware(['auth:employee'])->name('dashboard');


