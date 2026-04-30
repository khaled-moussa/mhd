<?php

namespace App\Support\Context;

class SectionContext
{
    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    */
    private static mixed $cachedSections = null;

    /*
    |--------------------------------------------------------------------------
    | Resolver
    |--------------------------------------------------------------------------
    */
    private static function resolve(): mixed
    {
        return self::$cachedSections ??= app('sections');
    }

    public static function clear(): void
    {
        self::$cachedSections = null;
    }

    /*
    |--------------------------------------------------------------------------
    | Collection
    |--------------------------------------------------------------------------
    */
    public static function toMapping(): object
    {
        return (object) collect(self::resolve())
            ->filter(fn($section) => self::isValidSection($section))
            ->mapWithKeys(fn($section) => [
                $section->key => (object) $section,
            ])->all();
    }

    public static function toCollection(): mixed
    {
        return self::resolve()->toResourceCollection();
    }

    public static function toArray(): array
    {
        return self::toCollection()->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public static function get(string $key, mixed $default = null): mixed
    {
        return self::toCollection()->get($key, $default);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    private static function isValidSection(mixed $section): bool
    {
        if (! $section->isVisible()) {
            return false;
        }

        if (! isset($section->key)) {
            return false;
        }

        return true;
    }
}
