<?php

namespace App\Support\Context;

use Illuminate\Support\Collection;

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
}