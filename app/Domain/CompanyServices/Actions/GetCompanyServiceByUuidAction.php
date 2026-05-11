<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\Models\CompanyService;

class GetCompanyServiceByUuidAction
{
    /*
    |-------------------------------
    | Get Company Service by UUID
    |-------------------------------
    */
    public function execute(string $uuid): CompanyService
    {
        return CompanyService::query()
            ->where('uuid', $uuid)
            ->firstOrFail();
    }
}