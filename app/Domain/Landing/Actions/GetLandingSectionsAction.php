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
        return LandingSection::query()->get();
    }
}
