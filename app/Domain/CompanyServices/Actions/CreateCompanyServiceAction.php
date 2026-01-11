<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\DTOs\CreateCompanyServiceDto;
use App\Domain\CompanyServices\Models\CompanyService;

class CreateCompanyServiceAction
{
    /**
     * Create a new company service.
     */
    public function execute(CreateCompanyServiceDto $dto): CompanyService
    {
        return CompanyService::create($dto->toArray());
    }
}
