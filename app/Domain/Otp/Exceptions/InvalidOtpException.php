<?php

namespace App\Domain\Otp\Exceptions;

use Exception;

class InvalidOtpException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'Invalid OTP',
            // type: 'error',
            // status: 400
        );
    }
}
