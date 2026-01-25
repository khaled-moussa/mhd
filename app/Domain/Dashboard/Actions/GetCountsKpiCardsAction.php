<?php

namespace App\Domain\Dashboard\Actions;

use App\Domain\CompanyProjects\Models\CompanyProject;
use App\Domain\CompanyServices\Models\CompanyService;
use App\Domain\Contacts\Models\Contact;
use App\Domain\Dashboard\DTOs\DashboardDto;

class GetCountsKpiCardsAction
{
    public function execute()
    {
        $projectsCount = CompanyProject::count();

        $servicesCount = CompanyService::count();

        $contactsCount = Contact::count();

        return new DashboardDto(
            projectsCount: $projectsCount,
            servicesCount: $servicesCount,
            contactsCount: $contactsCount
        );
    }
}
