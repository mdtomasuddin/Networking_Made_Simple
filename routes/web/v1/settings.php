<?php

use App\Http\Controllers\Web\V1\Settings\IntegrationController;
use App\Http\Controllers\Web\V1\Settings\MailController;
use App\Http\Controllers\Web\V1\Settings\PrivacyPolicyController;
use App\Http\Controllers\Web\V1\Settings\SocialMediaController;
use App\Http\Controllers\Web\V1\Settings\SystemSettingsController;
use App\Http\Controllers\Web\V1\Settings\TermsAndConditionsController;
use Illuminate\Support\Facades\Route;

//! Mail SMTP Settings
Route::resource('mail-setting', MailController::class);
//! System Settings
Route::resource('system-setting', SystemSettingsController::class);

// Integration Setting (Google, Stripe)
Route::controller(IntegrationController::class)->group(function () {
    Route::get('/integration-setting', 'index')->name('integration.setting');
    Route::patch('/google-setting', 'updateGoogleCredentials')->name('google.update');
    Route::patch('/stripe-setting', 'updateStripeCredentials')->name('stripe.update');
});

//! social media links
Route::resource('social-media-links', SocialMediaController::class);
//! Terms & Conditions
Route::resource('terms-and-conditions', TermsAndConditionsController::class);
//! Privacy Policy
Route::resource('privacy-policy', PrivacyPolicyController::class);
