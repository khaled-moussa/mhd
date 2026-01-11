<?php

namespace App\Domain\Auth\Exceptions;

class FailedToVerifyCodeException extends AuthException
{
    public function __construct()
    {
        parent::__construct(
            __('The verification code is invalid.')
        );
    }
}
