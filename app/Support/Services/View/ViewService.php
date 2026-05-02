<?php

namespace App\Support\Services\View;

use App\Domain\Otp\Enums\OtpEventsEnum;
use App\Domain\Otp\Enums\OtpExceptionsEnum;
use App\Domain\Otp\Enums\OtpTimerEnum;
use App\Support\Cache\EnumCache;
use App\Support\Context\AuthContext;
use App\Support\Context\SectionContext;
use App\Support\Enums\EventsEnum;
use App\Support\Enums\FormEnum;
use App\Support\Enums\FormStepEnum;
use App\Support\Enums\LabelEnum;
use App\Support\Enums\ModalEnum;
use App\Support\Helpers\EnumExporter;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ViewService
{
    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    public static function boot(): void
    {
        self::registerSharedEnums();
        self::registerSectionsComposers();
    }

    /*
    |--------------------------------------------------------------------------
    | Registerers
    |--------------------------------------------------------------------------
    */

    public static function registerSharedEnums(): void
    {
        self::shareEnums();
        self::shareModalIds();
        self::shareFormIds();
        self::shareAuthUser();
    }

    public static function registerSectionsComposers(): void
    {
        self::composeSections();
    }

    /*
    |--------------------------------------------------------------------------
    | Shared Enums
    |--------------------------------------------------------------------------
    */

    private static function shareEnums(): void
    {
        ViewFacade::share(
            'enums',
            EnumCache::remember('js', fn() => [
                'OTP' => [
                    'EVENTS' => EnumExporter::export(OtpEventsEnum::class),
                    'ERRORS' => EnumExporter::export(OtpExceptionsEnum::class),
                    'TIMER'  => EnumExporter::export(OtpTimerEnum::class),
                ],
                'UI' => [
                    'FORMS'  => EnumExporter::export(FormEnum::class),
                    'MODALS' => EnumExporter::export(ModalEnum::class),
                    'EVENTS' => EnumExporter::export(EventsEnum::class),
                    'LABELS' => EnumExporter::export(LabelEnum::class),
                    'STEPS'  => EnumExporter::export(FormStepEnum::class),
                ],
            ])
        );
    }

    private static function shareModalIds(): void
    {
        ViewFacade::share(
            'modalId',
            EnumCache::remember('modalId', fn() => EnumExporter::export(ModalEnum::class))
        );
    }

    private static function shareFormIds(): void
    {
        ViewFacade::share(
            'formId',
            EnumCache::remember('form', fn() => EnumExporter::export(FormEnum::class))
        );
    }

    private static function shareAuthUser(): void
    {
        ViewFacade::composer('layouts.app', function ($view) {
            $view->with([
                'user' => AuthContext::toResource(),
            ]);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | View Composers
    |--------------------------------------------------------------------------
    */

    private static function composeSections(): void
    {
        ViewFacade::composer(
            'pages.guest.landing.*',
            function (View $view) {
                $view->with('sections', SectionContext::toMapping());
            }
        );
    }
}
