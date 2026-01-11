<?php

namespace App\Support\Cache;

use Illuminate\Support\Facades\Cache;

class EnumCache
{
    public static function remember(string $key, callable $callback): array
    {
        return Cache::rememberForever("enums:{$key}", $callback);
    }
}
