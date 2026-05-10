<?php

namespace App\Support\Context;

use App\Domain\CompanyProjects\Actions\GetCompanyProjectsAction;
use App\Domain\CompanyServices\Actions\GetCompanyServicesAction;
use App\Domain\Landing\Actions\GetLandingSectionsAction;
use App\Domain\Landing\Models\LandingSection;

class SectionContext
{
    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    */
    private static mixed $cachedSections = null;
    private static ?object $cachedMapping = null;

    /*
    |--------------------------------------------------------------------------
    | Resolver
    |--------------------------------------------------------------------------
    */
    private static function resolve(): mixed
    {
        return self::$cachedSections ??= app(GetLandingSectionsAction::class)->execute();
    }

    public static function clear(): void
    {
        self::$cachedSections = null;
        self::$cachedMapping = null;
    }

    /*
    |--------------------------------------------------------------------------
    | Collection
    |--------------------------------------------------------------------------
    */
    public static function toMapping(): object
    {
        return self::$cachedMapping ??= (object) collect(self::resolve())
            ->filter(fn($section) => self::isValidSection($section))
            ->mapWithKeys(function ($section) {

                match ($section->key) {
                    'projects' => $section->data = self::getProjectsData(limit: 6, visible: true),
                    'services' => $section->data = self::getServicesData(visible: true),
                    default => null,
                };

                return [
                    $section->key => (object) $section,
                ];
            })->all();
    }

    public static function toCollection(): mixed
    {
        return self::resolve()->toResourceCollection();
    }

    public static function all(): mixed
    {
        return self::$cachedMapping ??= (object) collect(self::resolve())
            ->mapWithKeys(function ($section) {

                match ($section->key) {
                    'projects' => $section->data = self::getProjectsData(limit: 6, visible: true),
                    'services' => $section->data = self::getServicesData(visible: true),
                    default => null,
                };

                return [
                    $section->key => (object) $section,
                ];
            })->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public static function get(string $key, mixed $default = null): mixed
    {
        return self::toMapping()->{$key} ?? $default;
    }

    public static function getCompanyLinks()
    {
        return self::get('footer', []);
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
    private static function isValidSection(mixed $section): bool
    {
        return $section->isVisible() && isset($section->key);
    }

    /*
    |--------------------------------------------------------------------------
    | Data Resolvers
    |--------------------------------------------------------------------------
    */
    private static function getProjectsData(?int $limit = null, ?bool $visible = null): array
    {
        $projects = app(GetCompanyProjectsAction::class)
            ->execute(limit: $limit, visible: $visible);

        return $projects->isEmpty() ? [] : $projects->toResourceCollection()->resolve();
    }

    private static function getServicesData(?bool $visible = null): array
    {
        $services = app(GetCompanyServicesAction::class)
            ->execute(visible: $visible);

        return $services->isEmpty() ? [] : $services->toResourceCollection()->resolve();
    }
}
