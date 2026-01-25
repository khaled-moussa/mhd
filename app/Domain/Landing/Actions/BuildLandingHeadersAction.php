<?php

namespace App\Domain\Landing\Actions;

class BuildLandingHeadersAction
{
    public function execute(array $sections, array $excluded = ['footer']): array
    {
        return collect($sections)
            ->reject(fn($section, $key) => in_array($key, $excluded, true))
            ->mapWithKeys(function ($section, $key) {
                return [
                    $key => [
                        'label' => $section['label'] ?? ucfirst($key),
                        'url'   => "#{$key}",
                    ],
                ];
            })
            ->toArray();
    }
}
