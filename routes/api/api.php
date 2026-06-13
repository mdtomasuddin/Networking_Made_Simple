<?php

use App\Http\Controllers\Api\V1\Category\CategoryController;
use App\Http\Controllers\Api\V1\User\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

//V1 API Routes
require 'v1/auth/auth.php'; //Auth routes

Route::apiResource('category', CategoryController::class);

// Profile routes
Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::apiResource('profile', ProfileController::class);
});
