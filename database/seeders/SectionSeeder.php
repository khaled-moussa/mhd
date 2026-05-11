<?php

namespace Database\Seeders;

use App\Domain\Landing\Actions\UpsertLandingSectionsAction;
use App\Domain\Landing\DTOs\CreateLandingSectionDto;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
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
            $dto = new CreateLandingSectionDto(
                key: $key,
                label: $section['label'],
                title: $section['title'],
                description: $section['description'],
                url: $section['url'] ?? null,
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
