<?php

namespace App\App\Web\Controllers\Panels\Admin\Dashboard;

use App\App\Web\Resources\Dashboard\DashboardResource;
use App\Domain\Dashboard\Actions\GetCountsKpiCardsAction;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(GetCountsKpiCardsAction $action)
    {
        $kpis = $action->execute();
        
        $dashboardData = (new DashboardResource($kpis))->resolve();

        return view('pages.panels.admin.dashboard.index', [
            'dashboardData' => $dashboardData,
        ]);
    }
}
