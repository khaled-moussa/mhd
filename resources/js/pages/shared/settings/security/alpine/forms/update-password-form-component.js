import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/utils/reset-form-validation";
import { FORMS, MODALS, UI_EVENTS } from "@js/utils/enums";
import { closeModal } from "@js/components/modal/_modal";
import { MODALS_EVENT } from "@js/utils/events";

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
            this.listenToUserPasswordUpdatedEvent();
            this.listenToModalClosedEvent();
        },

        listenToUserPasswordUpdatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.USER_PASSWORD_UPDATED_EVENT,
                ({ detail }) => {
                    MessageToast("updated", detail?.message);
                    closeModal({ modalId: MODALS.UPDATE_PASSWORD_MODAL });
                    resetFormValidation(FORMS.UPDATE_PASSWORD_FORM);
                },
            );
        },

        listenToModalClosedEvent() {
            window.addEventListener(
                MODALS_EVENT.closed(MODALS.UPDATE_PASSWORD_MODAL),
                () => {
                    resetFormValidation(FORMS.UPDATE_PASSWORD_FORM);
                },
            );
        },
    }));
});
