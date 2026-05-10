<?php

namespace App\Domain\CompanyServices\States\VisibilityStates;

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

    public function badge(): string
    {
        return 'danger';
    }

    public function textColor(): string
    {
        return "text-red-500";
    }

    public function icon(): string
    {
        return 'fi-rr-circle-xmark';
    }
}
