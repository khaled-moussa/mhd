<?php

namespace App\Domain\Dashboard\Actions;

use App\Domain\Dashboard\DTOs\DashboardDto;
use Illuminate\Support\Facades\DB;

class GetCountsKpiCardsAction
{
    public function execute()
    {
        $projectsCount = DB::table('company_projects')
            ->count();

        $servicesCount = DB::table('company_services')
            ->count();

        $usersVisitCount = DB::table('sessions')
            ->whereNotNull('user_id')
            ->count();

        return new DashboardDto(
            projectsCount: $projectsCount,
            servicesCount: $servicesCount,
            usersVisitCount: $usersVisitCount
        );
    }
}
