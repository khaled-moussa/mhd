<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\Models\CompanyService;

class GetCompanyServicesAction
{
    /**
     * Get all company services.
     */
    public function execute()
    {
        return CompanyService::query()
            ->latest('created_at')
            ->paginate(20);
    }
}
