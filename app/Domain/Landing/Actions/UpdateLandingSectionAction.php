<?php

namespace App\Domain\Landing\Actions;

use App\Domain\Landing\Models\LandingSection;
use Illuminate\Support\Arr;

class UpdateLandingSectionAction
{
    /**
     * Update existing landing sections only.
     */
    public function execute( $data, array $excludeColumns = []): void
    {
        if (empty($data)) {
            return;
        }

        foreach ($data as $key => $row) {
            // Remove key + excluded columns
            $updateData = Arr::except(
                $row,
                ['key', ...$excludeColumns]
            );

            LandingSection::where('key', $key)
                ->update($updateData);
        }
    }
}
