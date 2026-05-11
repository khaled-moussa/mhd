import { MODALS, FORMS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { showModal, closeModal } from "@js/components/modal/_modal";
import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/common/form/reset-form-validation.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("serviceFormUpdateComponent", () => ({
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
        | Actions
        |------------------------------- 
        */
        async editCompanyService(companyServiceUuid, triggerEl) {
            if (!this.isValidPayload(companyServiceUuid, triggerEl)) {
                return this.showError();
            }

            await this.$wire.call("editCompanyService", companyServiceUuid);

            showModal({
                modalId: MODALS.UPDATE_COMPANY_SERVICE_MODAL,
                callback: () => triggerEl.classList.remove("spinner"),
            });
        },

        /* 
        |-------------------------------
        | Helpers
        |------------------------------- 
        */
        isValidPayload(companyServiceUuid, triggerEl) {
            return Boolean(companyServiceUuid && triggerEl);
        },

        showError() {
            MessageToast("error");
        },

        /* 
        |-------------------------------
        | Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.onModalOpenedEvent();
            this.onServiceUpdatedEvent();
        },

        onModalOpenedEvent() {
            window.addEventListener(
                MODALS_EVENT.opened(MODALS.UPDATE_COMPANY_SERVICE_MODAL),
                ({ detail }) => {
                    const { companyServiceUuid, triggerEl } = detail ?? {};
                    this.editCompanyService(companyServiceUuid, triggerEl);
                },
            );
        },

        onServiceUpdatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_SERVICE_UPDATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.UPDATE_COMPANY_SERVICE_MODAL,
                    });

                    MessageToast("updated");
                    resetFormValidation(FORMS.UPDATE_COMPANY_SERVICE_FORM);
                },
            );
        },
    }));
});
