<?php

namespace App\Domain\Users\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class UserQueryBuilder extends Builder
{
    /**
     * Filter by UUID.
     */
    public function whereUuid(string $userUuid): self
    {
        return $this->where('uuid', $userUuid);
    }

    /**
     * Filter by email.
     */
    public function whereEmail(string $email): self
    {
        return $this->where('email', $email);
    }

    /**
     * Filter by social Id.
     */
    public function whereSocialId(string $socialId,): self
    {
        return $this->where('social_id', $socialId);
    }

    /**
     * Filter by panel Id.
     */
    public function wherePanelId(string $panel,): self
    {
        return $this->where('panel_id', $panel);
    }
}
