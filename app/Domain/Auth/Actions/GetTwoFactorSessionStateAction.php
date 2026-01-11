<?php

namespace App\Domain\Auth\Actions;

class GetTwoFactorSessionStateAction
{
    public function execute()
    {
        return session('two_factor_passed', false);
    }
}
