<?php

namespace App\Domain\Users\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'User not found',
            // type: 'error',
            // status: 400
        );
    }
}
