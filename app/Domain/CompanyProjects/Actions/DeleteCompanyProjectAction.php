<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteCompanyProjectAction
{
    /**
     * Delete the given company service.
     */
    public function execute(CompanyProject $companyProject): void
    {
        if (! $companyProject->exists) {
            throw new ModelNotFoundException('Cannot delete: CompanyProject instance not found or already deleted.');
        }

        $companyProject->delete();
    }
}
