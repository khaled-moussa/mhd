<?php

namespace App\Domain\Landing\Actions;

use App\Domain\Landing\Models\LandingSection;
use Illuminate\Support\Arr;

class UpdateLandingSectionAction
{
    /**
     * Update existing landing sections only.
     *
     * @param array $data
     * @param array $excludeColumns Columns that should NOT be updated
     */
    public function execute(array $data, array $excludeColumns = []): void
    {
        if (empty($data)) {
            return;
        }

        foreach ($data as $row) {
            $key = $row['key'];

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
