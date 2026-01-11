<?php

namespace App\Livewire\Support\Bases;

use App\Domain\Users\Actions\GetCurrentUserAction;
use Livewire\Component;

abstract class BaseLivewireComponent extends Component
{
    protected $user;

    final public function boot(GetCurrentUserAction $getUser): void
    {
        $this->user = $getUser->execute();
    }

    /**
     * Get authenticated user
     */
    final public function getUserProperty()
    {
        return $this->user;
    }

    /**
     * Get current panel
     */
    final public function getCurrentPanelProperty()
    {
        return $this->user->getPanelId();
    }
}
