<?php

namespace App\Support\Enums;

enum ModalIdsEnum: string
{
    // Security / User Modals
    case UPDATE_EMAIL_MODAL = 'update-email-modal';
    case UPDATE_PASSWORD_MODAL = 'update-password-modal';
    case UPDATE_TWO_FACTOR_MODAL = 'update-two-factor-modal';
    case DELETE_ACCOUNT_MODAL = 'delete-account-modal';

    // Company Services / Crud Modals
    case VIEW_COMPANY_SERVICE_MODAL   = 'view-company-service-modal';
    case CREATE_COMPANY_SERVICE_MODAL = 'create-company-service-modal';
    case UPDATE_COMPANY_SERVICE_MODAL = 'update-company-service-modal';
    case DELETE_COMPANY_SERVICE_MODAL = 'delete-company-service-modal';

    // Company Projects / Crud Modals
    case VIEW_COMPANY_PROJECT_MODAL   = 'view-company-project-modal';
    case CREATE_COMPANY_PROJECT_MODAL = 'create-company-project-modal';
    case UPDATE_COMPANY_PROJECT_MODAL = 'update-company-project-modal';
    case DELETE_COMPANY_PROJECT_MODAL = 'delete-company-project-modal';
}
