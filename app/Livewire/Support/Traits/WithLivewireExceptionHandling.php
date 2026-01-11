<?php

namespace App\Livewire\Support\Traits;

use App\Support\Enums\EventsEnum;
use Illuminate\Validation\ValidationException;
use Throwable;

trait WithLivewireExceptionHandling
{
    final public function exception($e, $stopPropagation)
    {
        // Ignore validation exceptions
        if ($e instanceof ValidationException) {
            return;
        }

        // Let component handle its own known exceptions
        if ($this->handleKnownExceptions($e, $stopPropagation)) {
            return;
        }

        // Fallback → global unknown error
        $this->handleUnknownException($e, $stopPropagation);
    }

    /**
     * Override this method in component if needed
     */
    protected function handleKnownExceptions(\Throwable $e, callable $stop): bool
    {
        return false;
    }

    protected function handleUnknownException(\Throwable $e, callable $stop): void
    {
        $this->dispatchGlobalErrorEvent();
        $stop();
    }

    protected function dispatchGlobalErrorEvent(): void
    {
        $this->dispatch(EventsEnum::GLOBAL_ERROR_EVENT);
    }
}
