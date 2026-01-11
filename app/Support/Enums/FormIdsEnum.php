<?php

namespace App\Support\Enums;

enum FormIdsEnum: string
{
    // Auth 
    case LOGIN_FORM = 'login-form';
    case REGISTER_FORM = 'register-form';
    case FORGOT_PASSWORD_FORM = 'forget-password-form';
    case RESET_PASSWORD_FORM = 'reset-password-form';
    case VERIFY_ACCOUNT_FORM = 'verify-account-form';
    case TWO_FACTOR_AUTH_FORM = 'two-factor-auth-form';

    // Security 
    case UPDATE_EMAIL_FORM = 'update-email-form';
    case UPDATE_PASSWORD_FORM = 'update-password-form';
    case UPDATE_TWO_FACTOR_FORM = 'update-two-factor-form';
    case DELETE_ACCOUNT_FORM = 'delete-account-form';
}
