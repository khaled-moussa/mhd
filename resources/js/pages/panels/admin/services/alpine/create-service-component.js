import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/utils/reset-form-validation";
import { closeModal } from "@js/components/modal/_modal";
import { MODALS, FORMS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";

document.addEventListener("alpine:init", () => {
    Alpine.data("serviceFormCreateComponent", () => ({
        /* 
        |-------------------------------
        | Init
        |------------------------------- 
        */
        init() {
            this.registerListeners();
        },

        /* 
        |-------------------------------
        | Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.onModalClosedEvent();
            this.onServiceCreatedEvent();
        },

        onModalClosedEvent() {
            window.addEventListener(
                MODALS_EVENT.closed(MODALS.CREATE_COMPANY_SERVICE_MODAL),
                () => {
                    resetFormValidation(FORMS.CREATE_COMPANY_SERVICE_FORM);
                },
            );
        },

        onServiceCreatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_SERVICE_CREATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.CREATE_COMPANY_SERVICE_MODAL,
                    });

                    MessageToast("created");
                    resetFormValidation(FORMS.CREATE_COMPANY_SERVICE_FORM);
                },
            );
        },
    }));
});
