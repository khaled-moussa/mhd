<?php

namespace App\Domain\Auth\Exceptions;

class FailedToRegisterException extends AuthException
{
    public function __construct()
    {
        parent::__construct(
            __('Registration failed. Please try again.')
        );
    }
}
