<?php

namespace App\Support\Enums;

enum FormStepEnum: string
{
    // Steps
    case PASSWORD_STEP = 'password';
    case EMAIL_STEP    = 'email';
    case OTP_STEP      = 'otp';
    case ACCOUNT_DELETED = 'account_deleted';
}
