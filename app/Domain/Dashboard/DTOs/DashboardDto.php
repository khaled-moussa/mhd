<?php

namespace App\Domain\Dashboard\DTOs;

class DashboardDto
{
    public function __construct(
        public int $projectsCount,
        public int $servicesCount,
        public int $contactsCount,
    ) {}
}
