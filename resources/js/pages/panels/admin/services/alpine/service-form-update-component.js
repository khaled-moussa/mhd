import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/utils/reset-form-validation";
import { showModal, closeModal } from "@js/components/modal/_modal";
import { MODALS, FORMS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";

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
            this.onModalOpened();
            this.onServiceServiceUpdatedEvent();
        },

        onModalOpened() {
            window.addEventListener(
                MODALS_EVENT.opened(MODALS.UPDATE_COMPANY_SERVICE_MODAL),
                ({ detail }) => {
                    const { companyServiceUuid, triggerEl } = detail ?? {};

                    this.editCompanyService(companyServiceUuid, triggerEl);
                },
            );
        },

        onServiceServiceUpdatedEvent() {
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
