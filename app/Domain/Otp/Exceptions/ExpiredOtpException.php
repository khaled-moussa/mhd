<?php

namespace App\Domain\Otp\Exceptions;

use Exception;

class ExpiredOtpException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'Expired OTP',
            // type: 'error',
            // status: 400
        );
    }
}
