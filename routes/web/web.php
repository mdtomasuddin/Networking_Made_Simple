<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\V1\Category\CategoryController;
use App\Http\Controllers\Web\V1\User\UserController;
use App\Http\Controllers\Web\V1\User\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
// Authentication Routes
require 'v1/auth.php';
// Settings Routes 
Route::middleware(['auth'])->group(function () {
    require 'v1/settings.php';
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin-profile', [UserController::class, 'index'])->name('admin.profile.index');
    Route::post('/admin-profile/update', [UserController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin-profile/password', [UserController::class, 'password'])->name('admin.profile.password');
    Route::post('/admin-profile/password', [UserController::class, 'updatePassword'])->name('admin.profile.password.update');
});

// categories
Route::post('/categories/status/{id}', [CategoryController::class, 'status'])->name('categories.status');
Route::resource('/categories', CategoryController::class);

//! user management
Route::post('/users/status/{id}', [UserManagementController::class, 'status'])->name('users.status');
Route::resource('users', UserManagementController::class);
