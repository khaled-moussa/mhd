<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetCompanyProjectByUuidAction
{
    /**
     * Get specific company service by uuid.
     */
    public function execute(string $companyProjectUuid): CompanyProject
    {
        $companyProject =  CompanyProject::whereUuid($companyProjectUuid)->first();

        if (! $companyProject) {
            throw new ModelNotFoundException('Cannot delete: CompanyProject instance not found or already deleted.');
        }

        return $companyProject;
    }
}
