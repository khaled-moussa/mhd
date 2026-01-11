<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\DTOs\UpdateCompanyServiceDto;
use App\Domain\CompanyServices\Models\CompanyService;

class UpdateCompanyServiceAction
{
    /**
     * Update an existing company service with new data.
     */
    public function execute(CompanyService $companyService, UpdateCompanyServiceDto $dto): CompanyService
    {
        $companyService->update($dto->toArray());

        return $companyService->fresh();
    }
}
