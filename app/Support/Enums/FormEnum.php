<?php

namespace App\Support\Enums;

enum FormEnum: string
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

    // Company Services / Crud Modals
    case VIEW_COMPANY_SERVICE_FORM   = 'view-company-service-form';
    case CREATE_COMPANY_SERVICE_FORM = 'create-company-service-form';
    case UPDATE_COMPANY_SERVICE_FORM = 'update-company-service-form';
    case DELETE_COMPANY_SERVICE_FORM = 'delete-company-service-form';

    // Company Projects / Crud Modals
    case VIEW_COMPANY_PROJECT_FORM   = 'view-company-project-form';
    case CREATE_COMPANY_PROJECT_FORM = 'create-company-project-form';
    case UPDATE_COMPANY_PROJECT_FORM = 'update-company-project-form';
    case DELETE_COMPANY_PROJECT_FORM = 'delete-company-project-form';

    // Company Projects / Crud Modals
    case VIEW_CONTACT_FORM   = 'view-contact-form';
    case CREATE_CONTACT_FORM = 'create-contact-form';
    case UPDATE_CONTACT_FORM = 'update-contact-form';
    case DELETE_CONTACT_FORM = 'delete-contact-form';
}
