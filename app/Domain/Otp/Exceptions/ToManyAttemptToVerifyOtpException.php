<?php

namespace App\Domain\Otp\Exceptions;

use Exception;

class ToManyAttemptToVerifyOtpException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'Too many attempet to verify otp',
            // type: 'error',
            // status: 400
        );
    }
}
