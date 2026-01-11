<?php

namespace App\Domain\Auth\Exceptions;

class FailedToForgetPasswordException extends AuthException
{
    public function __construct()
    {
        parent::__construct(
            __('Failed to reset your password. Please try again later.')
        );
    }
}
