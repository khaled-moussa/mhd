<?php

use App\App\Web\Controllers\Guest\Landing\LandingController;
use App\App\Web\Controllers\Guest\Projects\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
| Publicly accessible web routes.
|--------------------------------------------------------------------------
*/

Route::get('/', LandingController::class)
    ->name('landing');

Route::get('/projects', ProjectController::class)
    ->name('projects');
