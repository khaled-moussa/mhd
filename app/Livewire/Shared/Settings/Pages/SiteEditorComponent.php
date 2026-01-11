<?php

namespace App\Livewire\Shared\Settings\Pages;

use App\App\Web\Resources\SiteEditors\SiteEditorsResource;
use App\Domain\Landing\Actions\GetLandingSectionsAction;
use App\Domain\Landing\Actions\UpsertLandingSectionsAction;
use App\Domain\Landing\DTOs\LandingSectionDto;
use App\Livewire\Support\Traits\WithLivewireExceptionHandling;
use App\Support\Enums\EventsEnum;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SiteEditorComponent extends Component
{
    use WithLivewireExceptionHandling;

    /*
    |-----------------------------
    | Properties
    |-----------------------------
    */
    public array $landingSectionsData = [];

    /*
    |-----------------------------
    | Lifecycle
    |-----------------------------
    */
    public function mount(): void
    {
        $this->landingSectionsData = $this->landingSectionsData();
    }

    public function render()
    {
        return view('livewire.shared.settings.pages.site-editor-component');
    }

    /* 
    |-----------------------------
    | Computed Properties
    |----------------------------- 
    */
    #[Computed]
    public function landingSections()
    {
        return app(GetLandingSectionsAction::class)->execute();
    }


    #[Computed]
    public function landingSectionsData(): array
    {
        return SiteEditorsResource::collection(
            $this->landingSections
        )->resolve();
    }

    /*
    |-----------------------------
    | Actions
    |-----------------------------
    */
    public function submit(array $sections): void
    {
        $dtos = [];

        if (empty($sections)) {
            return;
        }

        foreach ($sections as $section) {
            $dto = new LandingSectionDto(
                key: $section['key'],
                title: $section['title'] ?? null,
                description: $section['description'] ?? null,
                visible: $section['visible'] ?? true,
                order: $section['order'] ?? null,
                data: $section['data'] ?? [],
            );

            $dtos[] = $dto->toArray();
        }

        app(UpsertLandingSectionsAction::class)
            ->execute($dtos);

        $this->dispatchSiteUpdatedEvent();
    }

    /*
    |-----------------------------
    | Events
    |-----------------------------
    */
    private function dispatchSiteUpdatedEvent(): void
    {
        $this->dispatch(EventsEnum::SITE_UPDATED_EVENT);
    }
}
