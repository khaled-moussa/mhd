<?php

namespace Database\Seeders;

use App\Domain\Landing\Actions\UpsertLandingSectionsAction;
use App\Domain\Landing\DTOs\LandingSectionDto;
use Illuminate\Database\Seeder;

class LandingSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSections = config('landing.sections', []);

        if (empty($defaultSections)) {
            return;
        }

        $dtos = [];
        $index = 1;

        foreach ($defaultSections as $key => $section) {
            $dto = new LandingSectionDto(
                key: $key,
                title: $section['title'] ?? null,
                description: $section['description'] ?? null,
                visible: $section['visible'] ?? true,
                order: $section['order'] ?? $index,
                data: $section['data'] ?? []
            );

            $dtos[] = $dto->toArray();
            $index++;
        }

        app(UpsertLandingSectionsAction::class)->execute($dtos);
    }
}
