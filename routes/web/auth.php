<?php

use App\App\Web\Controllers\Auth\EmailVerificationController;
use App\App\Web\Controllers\Auth\LoginController;
use App\App\Web\Controllers\Auth\RegisterController;
use App\App\Web\Controllers\Auth\ForgotPasswordController;
use App\App\Web\Controllers\Auth\LogoutController;
use App\App\Web\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| Routes related to user authentication and account security.
|--------------------------------------------------------------------------
*/

Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::get('/login', LoginController::class)->name('login');
        Route::get('/register', RegisterController::class)->name('register');
        Route::get('/forgot-password', ForgotPasswordController::class)->name('forgot-password');
        Route::get('/reset-password', ResetPasswordController::class)->name('reset-password');
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

        Route::post('logout', LogoutController::class)
            ->name('logout');
    });
