<?php

namespace App\Domain\Landing\Actions;

use App\Domain\Landing\Models\LandingSection;

class GetSectionByKeyAction
{
    /*
    |-------------------------------
    | Get Landing Sections
    |-------------------------------
    */
    public function execute(string $key): LandingSection
    {
        return LandingSection::query()
            ->where('key', $key)
            ->first();
    }
}
