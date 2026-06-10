<?php

use App\Http\Controllers\Web\V1\Setting\MailController;
use App\Http\Controllers\Web\V1\SystemSettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings/mail')->name('v1.setting.mail.')->controller(MailController::class)
    ->group(function () {
        Route::get('/', 'show')->name('show');
        Route::post('/', 'store')->name('store');
    });



//! Route for System Settings
Route::controller(SystemSettingsController::class)->group(function () {
    Route::get('/system-setting', 'index')->name('system.index');
    Route::patch('/system-setting', 'update')->name('system.update');
});
