<?php

namespace App\Domain\Otp\Exceptions;

use Exception;

class ToManyAttemptOtpRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'Too many OTP requests.',
            // type: 'error',
            // status: 400
        );
    }
}
