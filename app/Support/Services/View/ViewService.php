<?php

namespace App\Support\Services\View;

use App\Domain\Otp\Enums\OtpEventsEnum;
use App\Domain\Otp\Enums\OtpExceptionsEnum;
use App\Domain\Otp\Enums\OtpTimerEnum;
use App\Domain\Users\Actions\GetCurrentUserAction;
use App\Navigation\Sidebar\SidebarBuilder;
use App\Panel\Resolvers\PanelManager;
use App\Support\Cache\EnumCache;
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
        self::registerPanelComposers();
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
    }

    public static function registerPanelComposers(): void
    {
        self::composeSidebar();
        self::composeUserPanel();
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

    /*
    |--------------------------------------------------------------------------
    | View Composers
    |--------------------------------------------------------------------------
    */

    private static function composeSidebar(): void
    {
        ViewFacade::composer(
            'components.navigation.sidebar.app',
            function (View $view) {
                $panel   = app(PanelManager::class)->current();
                $sidebar = app(SidebarBuilder::class);

                $view->with([
                    'panel'         => $panel,
                    'primaryMenu'   => $sidebar->buildPrimary($panel),
                    'secondaryMenu' => $sidebar->buildSecondary($panel),
                ]);
            }
        );
    }

    private static function composeUserPanel(): void
    {
        ViewFacade::composer(
            [
                'pages.shared.*',
                'components.dropdown.profile',
            ],
            function (View $view) {
                $panelId = app(GetCurrentUserAction::class)
                    ->execute()
                    ->getPanelId();

                $view->with('panel', $panelId);
            }
        );
    }

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
