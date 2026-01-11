<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\Models\CompanyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteCompanyServiceAction
{
    /**
     * Delete the given company service.
     */
    public function execute(CompanyService $companyService): void
    {
        if (! $companyService->exists) {
            throw new ModelNotFoundException('Cannot delete: CompanyService instance not found or already deleted.');
        }

        $companyService->delete();
    }
}
