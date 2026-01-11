<?php

namespace App\Livewire\Shared\Settings\Bases;

use App\Livewire\Support\Bases\BaseLivewireComponent;

abstract class BaseSettingComponent extends BaseLivewireComponent
{
    /**
     * Get related setting model (lazy loaded)
     */
    public function getSettingProperty()
    {
        return $this->user->setting ?? $this->user->load('setting')->setting;
    }
}
