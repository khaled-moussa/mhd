<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| The web routes for the application.
| Additional route files are loaded for better organization.
|--------------------------------------------------------------------------
*/

// Public (guest) routes
require base_path('routes/web/guest.php');

// Authentication routes
require base_path('routes/web/auth.php');

// Admin panel routes
require base_path('routes/web/admin.php');

// User panel routes
require base_path('routes/web/user.php');