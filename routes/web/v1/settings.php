<?php

use App\Http\Controllers\Web\V1\Settings\IntegrationController;
use App\Http\Controllers\Web\V1\Settings\MailController;
use App\Http\Controllers\Web\V1\Settings\SocialMediaController;
use App\Http\Controllers\Web\V1\Settings\SystemSettingsController;
use Illuminate\Support\Facades\Route;

// Mail SMTP Settings
Route::prefix('settings/mail')->name('v1.setting.mail.')->controller(MailController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::post('/', 'store')->name('store');
});

// System Settings
Route::controller(SystemSettingsController::class)->group(function () {
    Route::get('/system-setting', 'index')->name('system.index');
    Route::patch('/system-setting', 'update')->name('system.update');
});

// Integration Setting (Google, Stripe)
Route::controller(IntegrationController::class)->group(function () {
    Route::get('/integration-setting', 'index')->name('integration.setting');
    Route::patch('/google-setting', 'updateGoogleCredentials')->name('google.update');
    Route::patch('/stripe-setting', 'updateStripeCredentials')->name('stripe.update');
});

//! social media links
Route::resource('social-media-links', SocialMediaController::class);
