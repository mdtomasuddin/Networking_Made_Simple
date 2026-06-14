<?php

use App\Http\Controllers\Api\V1\Education\EducationController;
use App\Http\Controllers\Api\V1\Expertise\ExpertiseController;
use App\Http\Controllers\Api\V1\Recognition\RecognitionController;
use App\Http\Controllers\Api\V1\User\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

//V1 API Routes
require 'v1/auth/auth.php'; //Auth routes
require 'v1/cms/cms.php';  //cms routes


// Profile routes
Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::apiResource('profile', ProfileController::class);
    Route::apiResource('experience', ExpertiseController::class);
    Route::apiResource('education', EducationController::class);
    Route::apiResource('recognition', RecognitionController::class);
});
