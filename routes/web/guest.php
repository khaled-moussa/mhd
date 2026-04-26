<?php

use App\App\Web\Controllers\Guest\Landing\LandingController;
use App\App\Web\Controllers\Guest\Projects\ProjectController;
use App\Support\Context\SectionContext;
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


Route::get('test', function () {
    $test = SectionContext::toCollection();
    dd($test->resolve());
});
