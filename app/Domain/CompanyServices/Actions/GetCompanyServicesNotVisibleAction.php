<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\Models\CompanyService;
use Illuminate\Support\Collection;

class GetCompanyServicesNotVisibleAction
{
    /**
     * Get company services that are not visible.
     */
    public function execute(): Collection
    {
        return CompanyService::query()
            ->notVisible()
            ->get();
    }
}
