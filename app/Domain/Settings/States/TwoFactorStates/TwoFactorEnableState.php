<?php

namespace App\Domain\Settings\States\TwoFactorStates;

class TwoFactorEnableState extends TwoFactorStates
{
    public function value(): bool
    {
        return true;
    }

    public function label(): string
    {
        return 'Enable';
    }

    public function buttonLabel(): string
    {
        return 'Disable';
    }

    public function colorClass(): string
    {
        return 'success';
    }
}
