<?php

namespace App\Domain\Landing\Actions;

use App\Domain\Landing\Models\LandingSection;
use Illuminate\Support\Collection;

class GetLandingSectionsAction
{
    /**
     * Retrieve all landing sections by merging defaults with database overrides.
     */
    public function execute(): Collection
    {
        return LandingSection::get()->keyBy('key')->sortBy('order');
    }
}
