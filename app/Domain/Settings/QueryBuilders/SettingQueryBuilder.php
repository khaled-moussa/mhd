<?php

namespace App\Domain\Settings\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class SettingQueryBuilder extends Builder
{
    /**
     * Filter by UUID.
     */
    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }

    /**
     * Filter by User ID.
     */
    public function whereUserId(int $userId): self
    {
        return $this->where('user_id', $userId);
    }
}
