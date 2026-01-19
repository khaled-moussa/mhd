<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class GetVisibleCompanyProjectsAction
{
    /**
     * Get all company services.
     */
    public function execute(int $perPage = 15)
    {
        return CompanyProject::query()
            ->visible()
            ->latest('created_at')
            ->paginate($perPage);
    }
}
