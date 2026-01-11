<?php

namespace App\App\Web\Controllers\Panels\Admin\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('pages.panels.admin.dashboard.index');
    }
}
