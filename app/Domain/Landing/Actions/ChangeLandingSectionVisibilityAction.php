<?php

namespace App\Domain\Landing\Actions;

use App\Domain\Landing\Models\LandingSection;
use App\Domain\Landing\VisibilityStates\NotVisibleState;

class ChangeLandingSectionVisibilityAction
{
    /*
    |-------------------------------
    | Update Visibility State
    |-------------------------------
    */
    public function execute(LandingSection $section, string $visibilityState): void
    {
        $state = $section->getVisibility();

        if (! $state->canTransitionTo($visibilityState)) {
            return;
        }

        if ($visibilityState == NotVisibleState::class) {
            $state->transitionTo($visibilityState);
            $section->data = [];
            return;
        }

        $state->transitionTo($visibilityState);
    }
}
