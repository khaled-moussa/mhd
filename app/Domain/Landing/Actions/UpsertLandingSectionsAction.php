<?php

namespace App\Domain\Landing\Actions;

use App\Domain\Landing\Models\LandingSection;

class UpsertLandingSectionsAction
{
    /**
     * Insert or update landing sections into the database.
     */
    public function execute(array $data): void
    {
        if (empty($data)) {
            return;
        }

        LandingSection::upsert(
            $data,
            ['key'], // match existing rows
            ['title', 'description', 'order', 'visibility_state', 'data']
        );
    }
}
