<?php

namespace App\Support\Services\View;

use App\Domain\Otp\Enums\OtpEventsEnum;
use App\Domain\Otp\Enums\OtpExceptionsEnum;
use App\Domain\Otp\Enums\OtpTimerEnum;
use App\Support\Cache\EnumCache;
use App\Support\Enums\EventsEnum;
use App\Support\Enums\FormIdsEnum;
use App\Support\Enums\FormStepEnum;
use App\Support\Enums\LabelsEnum;
use App\Support\Enums\ModalIdsEnum;
use App\Support\Helpers\EnumExporter;
use Illuminate\Support\Facades\View;

class EnumViewService
{
    public function boot(): void
    {
        View::share('JS_ENUMS', EnumCache::remember('js', function () {
            return [
                'OTP' => [
                    'EVENTS' => EnumExporter::export(OtpEventsEnum::class),
                    'ERRORS' => EnumExporter::export(OtpExceptionsEnum::class),
                    'TIMER'  => EnumExporter::export(OtpTimerEnum::class),
                ],

                'UI' => [
                    'FORMS'  => EnumExporter::export(FormIdsEnum::class),
                    'MODALS' => EnumExporter::export(ModalIdsEnum::class),
                    'EVENTS' => EnumExporter::export(EventsEnum::class),
                    'LABELS' => EnumExporter::export(LabelsEnum::class),
                    'STEPS'  => EnumExporter::export(FormStepEnum::class),
                ],
            ];
        }));

        View::share(
            'modal',
            EnumCache::remember('modal', function () {
                return EnumExporter::export(ModalIdsEnum::class);
            })
        );

        View::share(
            'formId',
            EnumCache::remember('formId', function () {
                return EnumExporter::export(FormIdsEnum::class);
            })
        );
    }
}
