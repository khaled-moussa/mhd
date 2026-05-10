<?php

namespace App\Domain\CompanyServices\QueryBuilders;

use App\Domain\CompanyServices\States\VisibilityStates\NotVisibleState;
use App\Domain\CompanyServices\States\VisibilityStates\VisibleState;
use Illuminate\Database\Eloquent\Builder;

class CompanyServiceBuilder extends Builder
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
