<?php

namespace App\Domain\Otp\Enums;

enum OtpExceptionsEnum: string
{
    /* 
    |-------------------------------
    | Rate Limit Exceptions
    |------------------------------- 
    */
    case RESEND_LIMIT  = 'ToManyAttemptOtpRequestException';
    case VERIFY_LIMIT  = 'ToManyAttemptToVerifyOtpException';

        /*
    |-------------------------------
    | OTP Validation Exceptions
    |------------------------------- 
    */
    case EXPIRED       = 'ExpiredOtpException';
    case INVALID       = 'InvalidOtpException';
}
