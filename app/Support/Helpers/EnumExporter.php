<?php

namespace App\Support\Helpers;

use BackedEnum;

class EnumExporter
{
    public static function export(string $enum): array
    {
        return collect($enum::cases())
            ->mapWithKeys(fn (BackedEnum $case) => [
                $case->name => $case->value,
            ])
            ->toArray();
    }
}
