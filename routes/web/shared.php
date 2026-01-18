<?php

use App\App\Web\Controllers\Shared\Settings\NotificationController;
use App\App\Web\Controllers\Shared\Settings\ProfileController;
use App\App\Web\Controllers\Shared\Settings\SecurityController;
use App\App\Web\Controllers\Shared\Settings\SiteEditorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Shared Settings Routes
|--------------------------------------------------------------------------
| Routes shared across panels (admin, user).
|--------------------------------------------------------------------------
*/

Route::prefix('settings')
    ->as('settings.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */
        Route::get('profile', ProfileController::class)
            ->name('profile');

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */
        Route::get('security', SecurityController::class)
            ->name('security');

        /*
        |--------------------------------------------------------------------------
        | Site Editor
        |--------------------------------------------------------------------------
        */
        Route::get('site-editor', [SiteEditorController::class, 'index'])
            ->name('site-editor');

        Route::get('site-preview', [SiteEditorController::class, 'view'])
            ->name('site-preview');
    });
