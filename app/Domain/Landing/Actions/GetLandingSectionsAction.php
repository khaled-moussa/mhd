<?php

namespace App\Domain\Landing\Actions;

use App\Domain\Landing\Models\LandingSection;
use Illuminate\Support\Collection;

class GetLandingSectionsAction
{
    /*
    |-------------------------------
    | Get Landing Sections
    |-------------------------------
    */
    public function execute(): Collection
    {
        return LandingSection::query()
            ->orderBy('order')
            ->get();
    }

    public function mapWithKeys(): array
    {
        return $this->execute()
            ->mapWithKeys(fn($section) => [
                $section->key => $section->toResource()->resolve(),
            ])->toArray();
    }
}
