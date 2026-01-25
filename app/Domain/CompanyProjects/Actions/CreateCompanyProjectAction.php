<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\DTOs\CreateCompanyProjectDto;
use App\Domain\CompanyProjects\Models\CompanyProject;

class CreateCompanyProjectAction
{
    /**
     * Create a new company service.
     */
    public function execute(CreateCompanyProjectDto $dto): CompanyProject
    {
        return CompanyProject::create($dto->toArray());
    }
}
