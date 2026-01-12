<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Support\Collection;

class GetCompanyProjectsVisibleAction
{
    /**
     * Get company services that are visible.
     */
    public function execute(): Collection
    {
        return CompanyProject::query()
            ->visible()
            ->get();
    }
}
