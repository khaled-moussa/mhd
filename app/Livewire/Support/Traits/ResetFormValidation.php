<?php

namespace App\Livewire\Support\Traits;

use App\Support\Enums\EventsEnum;

trait ResetFormValidation
{
    public function dispatchResetFormValidation(?string $formId = null): void
    {
        if (!$formId) {
            return;
        }

        $this->dispatch(EventsEnum::RESET_FORM_VALIDATION, formId: $formId);
    }
}
