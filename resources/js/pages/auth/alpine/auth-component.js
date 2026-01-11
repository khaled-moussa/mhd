import resetFormValidation from "@js/utils/reset-form-validation";
import { FORMS, UI_EVENTS } from "@js/utils/enums";
import MessageToast from "@js/utils/message-toast";

document.addEventListener("alpine:init", () => {
    Alpine.data("authComponent", () => ({
        /* 
        |-------------------------------
        |   Initialization
        |------------------------------- 
        */
        init() {
            this.initListeners();
        },

        /* 
        |-------------------------------
        |   Registration listeners
        |------------------------------- 
        */
        initListeners() {
            this.listenToLoginSuccessEvent();
            this.listenToRegistredSuccessEvenet();
            this.listenToForgotPasswordSuccessEvenet();
            this.listenToResetPasswordSuccessEvenet();
            this.listenToAuthErrorEvent();
        },

        /* 
        |-------------------------------
        |   Listeners
        |------------------------------- 
        */
        listenToLoginSuccessEvent() {
            window.addEventListener(UI_EVENTS.LOGIN_SUCCESS_EVENT, () => {
                resetFormValidation(FORMS.LOGIN_FORM);
            });
        },

        listenToRegistredSuccessEvenet() {
            window.addEventListener(UI_EVENTS.REGISTER_SUCCESS_EVENT, () => {
                resetFormValidation(FORMS.REGISTER_FORM);
            });
        },

        listenToForgotPasswordSuccessEvenet() {
            window.addEventListener(UI_EVENTS.FORGOT_PASSWORD_SUCCESS_EVENT, ({ detail }) => {
                MessageToast("success", detail?.message);
                resetFormValidation(FORMS.FORGOT_PASSWORD_FORM);
            });
        },

        listenToResetPasswordSuccessEvenet() {
            window.addEventListener(UI_EVENTS.RESET_PASSWORD_SUCCESS_EVENT, () => {
                resetFormValidation(FORMS.RESET_PASSWORD_FORM);
            });
        },

        listenToAuthErrorEvent() {
            window.addEventListener(UI_EVENTS.AUTH_ERROR_EVENT, () => {
                MessageToast("error");
            });
        },
    }));
});
