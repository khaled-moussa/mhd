<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\Models\CompanyService;
use Illuminate\Support\Collection;

class GetCompanyServicesVisibleAction
{
    /**
     * Get company services that are visible.
     */
    public function execute(): Collection
    {
        return CompanyService::query()
            ->visible()
            ->get();
    }
}
