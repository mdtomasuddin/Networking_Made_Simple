<?php

use App\Http\Controllers\Api\V1\CMS\SocialMedia\SocialMediaController;
use App\Http\Controllers\Api\V1\CMS\TermsAndPrivacyController;
use App\Http\Controllers\Api\V1\Settings\SystemSettingController;
use Illuminate\Support\Facades\Route;

//! V1 CMS Routes
Route::prefix('v1')->group(function () {
    //! terms and privacy
    Route::get('content/{type?}', [TermsAndPrivacyController::class, 'index']);
    //! social-media
    Route::apiResource('social-media', SocialMediaController::class);
    //! system settings
    Route::get('system-settings', [SystemSettingController::class, 'index']);
});
