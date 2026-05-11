<?php

namespace App\Domain\CompanyServices\Actions;

use App\Domain\CompanyServices\DTOs\CreateCompanyServiceDto;
use App\Domain\CompanyServices\Models\CompanyService;
use App\Domain\Landing\Actions\ChangeLandingSectionVisibilityAction;
use App\Domain\Landing\Actions\GetSectionByKeyAction;
use App\Domain\Landing\VisibilityStates\VisibleState;

class CreateCompanyServiceAction
{
    /*
    |-------------------------------
    | Create Company Service
    |-------------------------------
    */
    public function execute(CreateCompanyServiceDto $dto): CompanyService
    {
        $project = CompanyService::create($dto->toArray());

        $this->ensureServicesSectionIsVisible();

        return $project;
    }

    /*
    |-------------------------------
    | Ensure Projects Section Visible
    |-------------------------------
    */
    private function ensureServicesSectionIsVisible(): void
    {
        $section = app(GetSectionByKeyAction::class)->execute('services');

        if (!$section || $section->isVisible()) {
            return;
        }

        app(ChangeLandingSectionVisibilityAction::class)
            ->execute($section, VisibleState::class);
    }
}
