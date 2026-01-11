<?php

namespace App\Domain\Settings\States\TwoFactorStates;

class TwoFactorDisableState extends TwoFactorStates
{
    public function value(): bool
    {
        return false;
    }

    public function label(): string
    {
        return 'Disable';
    }

    public function buttonLabel(): string
    {
        return 'Enable';
    }

    public function colorClass(): string
    {
        return "warning";
    }
}
