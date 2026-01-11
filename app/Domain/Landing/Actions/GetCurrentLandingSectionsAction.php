<?php

namespace App\Domain\Landing\Actions;

use App\App\Web\Resources\CompanyServices\CompanyServicesResource;
use App\Domain\Landing\DTOs\LandingSectionDto;
use App\Domain\Landing\Models\LandingSection;
use App\Domain\CompanyServices\Actions\GetCompanyServicesVisibleAction;
use Illuminate\Support\Collection;

class GetCurrentLandingSectionsAction
{
    /**
     * Retrieve all landing sections by merging defaults with database overrides.
     */
    public function execute(): Collection
    {
        $configSections = config('landing.sections');
        $dbSections = LandingSection::get()->keyBy('key');

        $sections = collect();

        foreach ($configSections as $key => $defaults) {
            $section = $dbSections->get($key);

            $dto = new LandingSectionDto(
                key: $key,
                title: $section?->getTitle() ?? $defaults['title'] ?? null,
                description: $section?->getDescription() ?? $defaults['description'] ?? null,
                visible: $section?->getVisibility()?->value() ?? ($defaults['visible'] ?? true),
                order: $section?->getOrder() ?? ($defaults['order'] ?? null),
                data: $section?->getData() ?? $defaults['data'] ?? []
            );

            match ($key) {
                'services' => $this->attachServices($dto, $defaults),
                default => null,
            };

            $sections->put($key, $dto);
        }

        // Sort sections with order, keep unordered ones (like footer) last
        return $sections->sortBy(fn($section) => $section->order ?? PHP_INT_MAX);
    }

    /**
     * Attach Services section data.
     */
    protected function attachServices(LandingSectionDto $dto, array $defaults): void
    {
        $services = app(GetCompanyServicesVisibleAction::class)->execute();

        if ($services->isNotEmpty()) {
            $dto->data = CompanyServicesResource::collection($services)->resolve();
        } else {
            $dto->data = $defaults['data'] ?? [];
        }

        if (empty($dto->data)) {
            $dto->visible = false;
        }
    }
}
