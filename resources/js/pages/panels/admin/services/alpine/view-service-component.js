import { MODALS, FORMS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { showModal, closeModal } from "@js/components/modal/_modal";
import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/common/form/reset-form-validation.js";

document.addEventListener("alpine:init", () => {
    Alpine.data("viewServiceComponent", () => ({
        serviceData: {},

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
        async viewCompanyService(companyServiceData) {
            if (!companyServiceData) {
                return this.showError();
            }

            this.serviceData = companyServiceData;

            showModal({
                modalId: MODALS.VIEW_COMPANY_SERVICE_MODAL,
            });
        },

        /* 
        |-------------------------------
        | Helpers
        |------------------------------- 
        */

        showError() {
            MessageToast("error");
        },

        /* 
        |-------------------------------
        | Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.onServiceLoadedEvent();
        },

        onServiceLoadedEvent() {
            window.addEventListener(
                UI_EVENTS.COMPANY_SERVICE_LOADED_EVENT,
                ({ detail }) => {
                    this.viewCompanyService(detail.data);
                },
            );
        },
    }));
});
