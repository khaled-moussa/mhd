<?php

namespace App\Support\Services\View;

use App\Domain\Otp\Enums\OtpEventsEnum;
use App\Domain\Otp\Enums\OtpExceptionsEnum;
use App\Domain\Otp\Enums\OtpTimerEnum;
use App\Support\Cache\EnumCache;
use App\Support\Enums\EventsEnum;
use App\Support\Enums\FormEnum;
use App\Support\Enums\FormStepEnum;
use App\Support\Enums\LabelEnum;
use App\Support\Enums\ModalEnum;
use App\Support\Helpers\EnumExporter;
use Illuminate\Support\Facades\View;

class EnumViewService
{
    public function boot(): void
    {
        View::share(
            'enums',
            EnumCache::remember('js', function () {
                return [
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
                ];
            })
        );

        View::share(
            'modalId',
            EnumCache::remember('modalId', function () {
                return EnumExporter::export(ModalEnum::class);
            })
        );

        View::share(
            'formId',
            EnumCache::remember('form', function () {
                return EnumExporter::export(FormEnum::class);
            })
        );
    }
}
