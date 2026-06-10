<?php

use App\Http\Controllers\Api\V1\Category\CategoryController;
use Illuminate\Support\Facades\Route;

//V1 API Routes
require 'v1/auth/auth.php'; //Auth routes

Route::apiResource('category', CategoryController::class);
