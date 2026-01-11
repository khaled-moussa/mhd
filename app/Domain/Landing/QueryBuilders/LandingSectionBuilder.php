<?php

namespace App\Domain\Landing\QueryBuilders;

use App\Domain\CompanyServices\States\VisibilityStates\NotVisibleState;
use App\Domain\CompanyServices\States\VisibilityStates\VisibleState;
use Illuminate\Database\Eloquent\Builder;

class LandingSectionBuilder extends Builder
{
    /**
     * Filter by a specific visibility state class.
     *
     * @param class-string $stateClass
     */
    public function whereVisibility(string $stateClass): self
    {
        return $this->where('visibility_state', $stateClass);
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
