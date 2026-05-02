<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\DTOs\UpdateCompanyServiceDto;
use App\Domain\CompanyServices\Models\CompanyService;

class UpdateCompanyServiceAction
{
    /*
    |-------------------------------
    | Update Company Service
    |-------------------------------
    */
    public function execute(CompanyService $service, UpdateCompanyServiceDto $dto): CompanyService
    {
        $service->update($dto->toArray());

        return $service->refresh();
    }
}
