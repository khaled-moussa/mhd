<?php

namespace App\Domain\CompanyProjects\Actions;

use App\Domain\CompanyProjects\DTOs\UpdateCompanyProjectDto;
use App\Domain\CompanyProjects\Models\CompanyProject;

class UpdateCompanyProjectAction
{
    /**
     * Update an existing company service with new data.
     */
    public function execute(CompanyProject $companyProject, UpdateCompanyProjectDto $dto): CompanyProject
    {
        $companyProject->update($dto->toArray());

        return $companyProject->fresh();
    }
}
