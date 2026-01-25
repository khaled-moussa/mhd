<?php

namespace App\Domain\Landing\QueryBuilders;

use App\Domain\CompanyServices\States\VisibilityStates\NotVisibleState;
use App\Domain\CompanyServices\States\VisibilityStates\VisibleState;
use App\Domain\Landing\VisibilityStates\VisibilityStates;
use Illuminate\Database\Eloquent\Builder;

class LandingSectionBuilder extends Builder
{
    /**
     * Filter by a specific visibility state class.
     *
     * @param class-string $stateClass
     */
    public function whereVisibility(VisibilityStates $visibilityState): self
    {
        return $this->where('visibility_state', $visibilityState);
    }

    /**
     * Filter only visible services.
     */
    public function visible(): self
    {
        return $this->where('visibility_state', VisibleState::class);
    }

    /**
     * Filter only not visible services.
     */
    public function notVisible(): self
    {
        return $this->where('visibility_state', NotVisibleState::class);
    }
}
