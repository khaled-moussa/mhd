<?php

namespace App\Support\Enums;

enum EventsEnum: string
{
    // General / System Events
    case NOTIFICATION_SENT_EVENT = 'notification-sent-event';
    case SESSION_EXPIRED_EVENT = 'session-expired-event';
    case GLOBAL_ERROR_EVENT = 'global-error-exception';

    // Auth Events
    case LOGIN_SUCCESS_EVENT = 'login-success-event';
    case REGISTER_SUCCESS_EVENT = 'register-success-event';
    case FORGOT_PASSWORD_SUCCESS_EVENT = 'forget-password-success-event';
    case RESET_PASSWORD_SUCCESS_EVENT = 'reset-password-success-event';
    case TWO_FACTOR_SUCCESS_EVENT = 'two-factor-success-event';
    case AUTH_ERROR_EVENT = 'auth-error-event';

    // Steps / Navigation Events
    case STEP_NEXT_EVENT = 'step-next-event';
    case STEP_PREVIOUS_EVENT = 'step-previous-event';
    case STEP_COMPLETED_EVENT = 'step-completed-event';

    // Secuirty / Secuirty Events
    case USER_EMAIL_UPDATED_EVENT = 'user-email-updated-event';
    case USER_PASSWORD_UPDATED_EVENT = 'user-password-updated-event';
    case USER_PROFILE_UPDATED_EVENT = 'user-profile-updated-event';
    case USER_TWO_FACTOR_UPDATED_EVENT = 'user-two-factor-updated-event';
    case USER_ACCOUNT_DELETED_EVENT = 'user-account-deleted-event';
    case SITE_UPDATED_EVENT = 'site-updated-event';

    // Users / Crud Events
    case USER_CREATED_EVENT = 'user-created-event';
    case USER_UPDATED_EVENT = 'user-updated-event';
    case USER_DELETED_EVENT = 'user-deleted-event';
    case USER_ERROR_EVENT = 'user-error-event';
 
    // Company Services / Crud Events
    case COMPANY_SERVICE_CREATED_EVENT = 'company-service-created-event';
    case COMPANY_SERVICE_UPDATED_EVENT = 'company-service-updated-event';
    case COMPANY_SERVICE_DELETED_EVENT = 'company-service-deleted-event';
    case COMPANY_SERVICE_ERROR_EVENT   = 'company-service-error-event';

    // Company Projects / Crud Events
    case COMPANY_PROJECT_CREATED_EVENT = 'company-project-created-event';
    case COMPANY_PROJECT_UPDATED_EVENT = 'company-project-updated-event';
    case COMPANY_PROJECT_DELETED_EVENT = 'company-project-deleted-event';
    case COMPANY_PROJECT_ERROR_EVENT   = 'company-project-error-event';
}
