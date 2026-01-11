<?php

namespace App\Panel\Enums;

enum PanelEnum: string
{
    case ADMIN = 'admin';
    case USER  = 'user';

    /*
    |-----------------------------
    | Labels
    |-----------------------------
    */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::USER  => 'User',
        };
    }

    /*
    |-----------------------------
    | Values only
    |-----------------------------
    */
    public static function values(): array
    {
        return array_map(
            fn(self $case) => $case->value,
            self::cases()
        );
    }

    /*
    |-----------------------------
    | Select options (Blade ready)
    |-----------------------------
    */
    public static function selectOptions(): array
    {
        return array_map(
            fn(self $case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }
}
