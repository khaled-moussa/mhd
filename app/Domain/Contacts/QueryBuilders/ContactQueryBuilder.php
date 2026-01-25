<?php

namespace App\Domain\Contacts\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ContactQueryBuilder extends Builder
{
    /**
     * Filter by UUID.
     */
    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }
}
