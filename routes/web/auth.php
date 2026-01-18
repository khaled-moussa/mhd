<?php

use App\App\Web\Controllers\Auth\EmailVerificationController;
use App\App\Web\Controllers\Auth\ForgetPasswordController;
use App\App\Web\Controllers\Auth\LoginController;
use App\App\Web\Controllers\Auth\LogoutController;
use App\App\Web\Controllers\Auth\RegisterController;
use App\App\Web\Controllers\Auth\ResetPasswordController;
use App\App\Web\Controllers\Auth\TwoFactorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| Routes related to user authentication and account security.
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Guest Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('login', LoginController::class)
            ->name('login');

        // Route::get('register', RegisterController::class)
        //     ->name('register');

        Route::get('forgot-password', ForgetPasswordController::class)
            ->name('forgot-password');

        Route::get('reset-password/{email}/{token}', ResetPasswordController::class)
            ->name('reset-password');
    });

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('verify', [EmailVerificationController::class, 'index'])
            ->name('verification.notice');

        Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verification.verify');

        Route::post('verify/resend', [EmailVerificationController::class, 'resend'])
            ->name('verification.send');

        Route::get('two-factor-authentication', TwoFactorController::class)
            ->name('two-factor');

        Route::post('logout', LogoutController::class)
            ->name('logout');
    });
