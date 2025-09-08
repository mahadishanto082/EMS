<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\SlotController;

use App\Http\Controllers\Employee\EmployeeLoginController;
use App\Http\Controllers\Employee\RegisteredEmployeeController;
use App\Http\Controllers\Employee\ProfileController;
use App\Http\Controllers\Employee\LeaveRequestController;





Route::get('/', function () {
    return view('employee.auth.login');
        
    
});

// Employee Login Page
Route::get('/employee/login', function () {
    return view('employee.auth.login');
})->name('employee.auth.login');



// Login form page
Route::get('/employee/login', [EmployeeLoginController::class, 'create'])->name('employee.auth.login');

// Handle login submission
Route::post('/employee/login', [EmployeeLoginController::class, 'store'])->name('employee-login.store');
// Employee Registration Routes
Route::post('/employee/logout', [EmployeeLoginController::class, 'destroy'])
                ->middleware('auth:employee')
                ->name('employee.logout');



Route::get('/register', [RegisteredEmployeeController::class, 'create'])
                ->middleware('guest')
                ->name('register');
Route::post('/register', [RegisteredEmployeeController::class, 'store'])

                ->middleware('guest')
                ->name('register.store');
Route::get('/dashboard', function () {
    return view('employee.dashboard');
})->middleware(['auth:employee'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('employee.profile')->middleware('auth:employee');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('Employee.profile.edit')->middleware('auth:employee');
Route::put('/profile', [ProfileController::class, 'update'])->name('employee.profile.update')->middleware('auth:employee');

Route::resource('leave_requests', LeaveRequestController::class)->middleware('auth:employee');




Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Dashboard Route (Protected)
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->middleware('auth:admin')->name('home');


    Route::resource('employees', EmployeeController::class);
    Route::patch('/employees/{id}/toggle-status', [EmployeeController::class, 'toggleStatus'])
    ->name('employees.toggleStatus');

   Route::resource('leave_requests', LeaveController::class)->middleware('auth:admin');
   Route::patch('/leave_requests/{id}/approve', [LeaveController::class, 'approve'])
    ->name('leave_requests.approve')->middleware('auth:admin');
    Route::patch('/leave_requests/{id}/reject', [LeaveController::class, 'reject'])
    ->name('leave_requests.reject')->middleware('auth:admin');
    

   Route::resource('attendance', \App\Http\Controllers\Admin\AttendanceController::class)->middleware('auth:admin');
Route::resource('slots', SlotController::class)->middleware('auth:admin');
  
});