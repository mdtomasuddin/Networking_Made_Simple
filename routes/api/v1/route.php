<?php

use App\Http\Controllers\Api\V1\PageContentController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->controller(PageContentController::class)->group(function () {
    Route::get('/about', 'about');
    Route::get('/design', 'design');
    Route::get('/brainding', 'brainding');
    Route::get('/development', 'development');
    Route::get('/marketing', 'marketing');
    Route::get('/support', 'support');
    Route::get('/introduction', 'introduction');
    Route::get('/comments', 'comments');
    Route::get('/projects', 'projects');
});
