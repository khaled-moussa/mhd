<?php

namespace App\Domain\Landing\Actions;

use Illuminate\Support\Collection;

class FilterVisibleLandingSectionsAction
{
    /**
     * Filter all visible landing sections.
     */
    public function execute(Collection $sections): Collection
    {
        return $sections
            ->filter(fn($section) => $section->visible)
            ->sortBy('order');
    }
}
