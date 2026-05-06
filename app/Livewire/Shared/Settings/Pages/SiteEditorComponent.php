<?php

namespace App\Livewire\Shared\Settings\Pages;

use App\Domain\Landing\Actions\GetLandingSectionsAction;
use App\Domain\Landing\Actions\UpdateLandingSectionAction;
use App\Domain\Landing\DTOs\UpdateLandingSectionDto;
use App\Support\Enums\EventsEnum;
use Livewire\Component;

class SiteEditorComponent extends Component
{
    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    public array $sections = [];

    /*
    |--------------------------------------------------------------------------
    | Lifecycle
    |--------------------------------------------------------------------------
    */

    public function mount(): void
    {
        $this->sections = app(GetLandingSectionsAction::class)
            ->mapWithKeys();
    }

    public function render()
    {
        return view('livewire.shared.settings.pages.site-editor-component');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function submit(array $sections, array $order = []): void
    {
        if (empty($sections)) return;

        $dtos = collect($sections)
            ->map(fn($section) => new UpdateLandingSectionDto(
                key: $section['key'],
                title: $section['title']       ?? null,
                description: $section['description'] ?? null,
                visible: $section['visible']     ?? true,
                order: $section['order']       ?? 0,
                data: $section['data']        ?? [],
            ))->map->toArray();

        app(UpdateLandingSectionAction::class)->execute($dtos);

        $this->dispatch(EventsEnum::SITE_UPDATED_EVENT);
    }
}
