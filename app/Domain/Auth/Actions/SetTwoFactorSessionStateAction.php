<?php

namespace App\Domain\Auth\Actions;

class SetTwoFactorSessionStateAction
{
    public function execute(bool $state)
    {
        session()->put('two_factor_passed', $state);
    }
}
