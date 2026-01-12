<?php

use App\App\Web\Controllers\Panels\Admin\CompanyProjects\CompanyProjectController;
use App\App\Web\Controllers\Panels\Admin\Dashboard\DashboardController;
use App\App\Web\Controllers\Panels\Admin\CompanyServices\CompanyServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
| Routes restricted to authenticated administrators with permissions.
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'two-factor',
    'panel:admin',
])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */
        Route::get('dashboard', DashboardController::class)
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Company Services
        |--------------------------------------------------------------------------
        */
        Route::prefix('company-services')
            ->as('company-services.')
            ->group(function () {
                Route::get('/', CompanyServiceController::class)
                    ->name('index');
            });

        /*
        |--------------------------------------------------------------------------
        | Company Projects
        |--------------------------------------------------------------------------
        */
        Route::prefix('company-projects')
            ->as('company-projects.')
            ->group(function () {
                Route::get('/', CompanyProjectController::class)
                    ->name('index');
            });
        /*
        |--------------------------------------------------------------------------
        | Shared Admin Routes
        |--------------------------------------------------------------------------
        */
        require base_path('routes/web/shared.php');
    });
