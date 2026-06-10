<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\V1\Category\CategoryController;
use App\Http\Controllers\Web\V1\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
// Authentication Routes
require 'v1/auth.php';

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/password', [UserController::class, 'password'])->name('profile.password');
    Route::post('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
});

// categories
Route::post('/categories/status/{id}', [CategoryController::class, 'status'])->name('categories.status');
Route::resource('/categories', CategoryController::class);
