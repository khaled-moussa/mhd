<?php

namespace App\Domain\Otp\Enums;

enum OtpEventsEnum: string
{
    /* 
    |-------------------------------
    | Timer Events
    |------------------------------- 
    */
    case START_TIMER_EVENT    = 'otp:timer:start';
    case DESTROY_TIMER_EVENT  = 'otp:timer:destroy';

        /* 
    |-------------------------------
    | User Actions
    |------------------------------- 
    */
    case OTP_INPUT_EVENT      = 'otp:input';
    case RESET_OTP_INPUT_EVENT = 'otp:input:reset';
    case RESEND_EVENT         = 'otp:resend';
    case RESEND_LOCKED_EVENT  = 'otp:resend:locked';

        /* 
    |-------------------------------
    | Error Events
    |------------------------------- 
    */
    case OTP_ERROR_EVENT          = 'otp:error';
}
