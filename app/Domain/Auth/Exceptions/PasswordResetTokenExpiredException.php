<?php

namespace App\Domain\Auth\Exceptions;

class PasswordResetTokenExpiredException extends AuthException
{
    public function __construct()
    {
        parent::__construct(
            __("You can't proceed because the reset token has expired.")
        );
    }
}
