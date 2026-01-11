<?php

namespace App\Livewire\Support\Traits;

use App\Support\Enums\FormStepEnum;

trait WithSteps
{
    public FormStepEnum $step = FormStepEnum::PASSWORD_STEP;

    public function setStep(FormStepEnum $step): void
    {
        $this->step = $step;
    }

    public function resetSteps(): void
    {
        $this->step = FormStepEnum::PASSWORD_STEP;
    }

    public function is(FormStepEnum $step): bool
    {
        return $this->step === $step;
    }
}
