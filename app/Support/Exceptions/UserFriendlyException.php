<?php

namespace App\Support\Exceptions;

use Exception;

class UserFriendlyException extends Exception
{
    protected string $userMessage;

    public function __construct(string $userMessage, string $internalMessage = '', int $code = 0)
    {
        parent::__construct($internalMessage ?: $userMessage, $code);
        $this->userMessage = $userMessage;
    }

    public function getUserMessage(): string
    {
        return $this->userMessage;
    }
}
