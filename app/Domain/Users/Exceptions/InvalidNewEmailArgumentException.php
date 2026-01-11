<?php

namespace App\Domain\Users\Exceptions;

use Exception;

class InvalidNewEmailArgumentException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'New email address is required to send OTP for email verification.',
            // type: 'error',
            // status: 400
        );
    }
}
