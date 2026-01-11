<?php

namespace App\Domain\Otp\Enums;

enum OtpTimerEnum: int
{
    case DEFAULT_SECONDS = 30;
    case RESEND_LIMIT_SECONDS = 120;
}
