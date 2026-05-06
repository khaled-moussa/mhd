<?php

namespace App\Support\Enums;

enum EventsEnum: string
{
    /*
    |-------------------------------
    | System / General Events
    |-------------------------------
    */
    case NOTIFICATION_SENT_EVENT = 'notification-sent-event';
    case SESSION_EXPIRED_EVENT = 'session-expired-event';
    case GLOBAL_ERROR_EVENT = 'global-error-exception';

    /*
    |-------------------------------
    | Auth Events
    |-------------------------------
    */
    case LOGIN_SUCCESS_EVENT = 'login-success-event';
    case REGISTER_SUCCESS_EVENT = 'register-success-event';
    case FORGOT_PASSWORD_SUCCESS_EVENT = 'forget-password-success-event';
    case RESET_PASSWORD_SUCCESS_EVENT = 'reset-password-success-event';
    case TWO_FACTOR_SUCCESS_EVENT = 'two-factor-success-event';
    case AUTH_ERROR_EVENT = 'auth-error-event';

    /*
    |-------------------------------
    | Step Events
    |-------------------------------
    */
    case STEP_NEXT_EVENT = 'step-next-event';
    case STEP_PREVIOUS_EVENT = 'step-previous-event';
    case STEP_COMPLETED_EVENT = 'step-completed-event';

    /*
    |-------------------------------
    | User Events
    |-------------------------------
    */
    case USER_CREATED_EVENT = 'user-created-event';
    case USER_UPDATED_EVENT = 'user-updated-event';
    case USER_DELETED_EVENT = 'user-deleted-event';
    case USER_ERROR_EVENT = 'user-error-event';

    case USER_PROFILE_UPDATED_EVENT = 'user-profile-updated-event';
    case USER_EMAIL_UPDATED_EVENT = 'user-email-updated-event';
    case USER_PASSWORD_UPDATED_EVENT = 'user-password-updated-event';
    case USER_TWO_FACTOR_UPDATED_EVENT = 'user-two-factor-updated-event';
    case USER_ACCOUNT_DELETED_EVENT = 'user-account-deleted-event';

    /*
    |-------------------------------
    | Company Services
    |-------------------------------
    */
    case COMPANY_SERVICE_CREATED_EVENT = 'company-service-created-event';
    case COMPANY_SERVICE_UPDATED_EVENT = 'company-service-updated-event';
    case COMPANY_SERVICE_DELETED_EVENT = 'company-service-deleted-event';
    case COMPANY_SERVICE_LOADED_EVENT = 'company-service-loaded-event';
    case COMPANY_SERVICE_ERROR_EVENT = 'company-service-error-event';

    /*
    |-------------------------------
    | Company Projects
    |-------------------------------
    */
    case COMPANY_PROJECT_CREATED_EVENT = 'company-project-created-event';
    case COMPANY_PROJECT_UPDATED_EVENT = 'company-project-updated-event';
    case COMPANY_PROJECT_DELETED_EVENT = 'company-project-deleted-event';
    case COMPANY_PROJECT_LOADED_EVENT = 'company-project-loaded-event';
    case COMPANY_PROJECT_ERROR_EVENT = 'company-project-error-event';

    /*
    |-------------------------------
    | Contacts
    |-------------------------------
    */
    case CONTACT_CREATED_EVENT = 'contact-created-event';
    case CONTACT_UPDATED_EVENT = 'contact-updated-event';
    case CONTACT_DELETED_EVENT = 'contact-deleted-event';
    case CONTACT_LOADED_EVENT = 'contact-loaded-event';
    case CONTACT_ERROR_EVENT = 'contact-error-event';
    
    /*
    |-------------------------------
    | Site Editor
    |-------------------------------
    */
    case SITE_UPDATED_EVENT = 'site-updated-event';
}