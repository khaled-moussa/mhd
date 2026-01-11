<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\Models\CompanyService;

class GetCompanyServiceByUuidAction
{
    /**
     * Get specific company service by uuid.
     */
    public function execute(string $companyServiceUuid): CompanyService
    {
        return CompanyService::whereUuid($companyServiceUuid)->firstOrFail();
    }
}
