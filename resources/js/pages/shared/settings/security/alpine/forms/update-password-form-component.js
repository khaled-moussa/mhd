import { FORMS, MODALS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { closeModal } from "@js/components/modal/_modal";
import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/common/form/reset-form-validation.js";

/* 
|-----------------------------
| Alpine Component
|----------------------------- 
*/
document.addEventListener("alpine:init", () => {
    Alpine.data("updatePasswordFormComponent", () => ({
        /* 
        |-----------------------------
        | State
        |----------------------------- 
        */
        submitBtnId: "#submit-update-password-btn",
        submitBtnElement: null,

        /* 
        |-----------------------------
        | Init
        |----------------------------- 
        */
        init() {
            this.initElements();
            this.registerListeners();
        },

        initElements() {
            this.submitBtnElement = this.$el.querySelector(this.submitBtnId);
        },

        /* 
        |-----------------------------
        | Listeners
        |----------------------------- 
        */
        registerListeners() {
            this.onModalClosedEvent();
            this.onPasswordUpdatedEvent();
        },

        onModalClosedEvent() {
            window.addEventListener(
                MODALS_EVENT.closed(MODALS.UPDATE_PASSWORD_MODAL),
                () => {
                    resetFormValidation(FORMS.UPDATE_PASSWORD_FORM);
                },
            );
        },

        onPasswordUpdatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.USER_PASSWORD_UPDATED_EVENT,
                ({ detail }) => {
                    closeModal({ modalId: MODALS.UPDATE_PASSWORD_MODAL });

                    MessageToast("updated", detail?.message);
                    resetFormValidation(FORMS.UPDATE_PASSWORD_FORM);
                },
            );
        },
    }));
});
