import MessageToast from "@js/utils/message-toast";
import { closeModal, showModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";

document.addEventListener("alpine:init", () => {
    Alpine.data("companyServiceFormUpdateComponent", () => ({
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
        | Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.listenToModalOpened();
            this.listenToCompanyServiceUpdated();
        },

        listenToModalOpened() {
            window.addEventListener(
                MODALS_EVENT.opened(MODALS.UPDATE_COMPANY_SERVICE_MODAL),
                ({ detail }) => {
                    const { companyServiceUuid, triggerEl } = detail ?? {};

                    this.editCompanyService(companyServiceUuid, triggerEl);
                },
            );
        },

        listenToCompanyServiceUpdated() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_SERVICE_UPDATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.UPDATE_COMPANY_SERVICE_MODAL,
                    });
                    MessageToast("updated");
                },
            );
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
    }));
});
