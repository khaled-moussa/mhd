<?php

namespace App\Domain\CompanyProjects\QueryBuilders;

use App\Domain\CompanyProjects\States\VisibilityStates\VisibilityStates;
use App\Domain\CompanyProjects\States\VisibilityStates\NotVisibleState;
use App\Domain\CompanyProjects\States\VisibilityStates\VisibleState;
use Illuminate\Database\Eloquent\Builder;

class CompanyProjectBuilder extends Builder
{
    /**
     * Filter by UUID.
     */
    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }

    /**
     * Filter by a specific visibility state class.
     *
     * @param class-string $stateClass
     */
    public function whereVisibility(bool $visible): self
    {
        return $visible ? $this->visible() : $this->notVisible();
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
