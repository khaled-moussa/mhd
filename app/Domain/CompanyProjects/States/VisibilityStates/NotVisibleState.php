<?php

namespace App\Domain\CompanyProjects\States\VisibilityStates;

class NotVisibleState extends VisibilityStates
{
    public function label(): string
    {
        return 'Not Visible';
    }

    public function value(): bool
    {
        return false;
    }

    public function colorClass(): string
    {
        return 'danger';
    }
}
