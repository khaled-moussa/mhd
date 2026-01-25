<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;

class GetCompanyProjectsAction
{
    /**
     * Get all company services.
     */
    public function execute(int $perPage = 15)
    {
        return CompanyProject::query()
            ->latest('created_at')
            ->paginate($perPage);
    }
}
