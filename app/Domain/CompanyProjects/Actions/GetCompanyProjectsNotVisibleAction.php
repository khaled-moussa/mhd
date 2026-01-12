<?php

namespace App\Domain\CompanyProjects\Actions;

use Illuminate\Support\Collection;
use App\Domain\CompanyProjects\Models\CompanyProject;

class GetCompanyProjectsNotVisibleAction
{
    /**
     * Get company services that are not visible.
     */
    public function execute(): Collection
    {
        return CompanyProject::query()
            ->notVisible()
            ->get();
    }
}
