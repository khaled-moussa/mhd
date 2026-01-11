<?php

namespace App\Domain\Landing\VisibilityStates;

class VisibleState extends VisibilityStates
{
    public function label(): string
    {
        return 'Visible';
    }

    public function value(): bool
    {
        return true;
    }

    public function colorClass(): string
    {
        return "success";
    }
}
