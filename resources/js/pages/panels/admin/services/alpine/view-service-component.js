import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/utils/reset-form-validation";
import { showModal, closeModal } from "@js/components/modal/_modal";
import { MODALS, FORMS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";

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
            this.onServiceDataLoaded();
        },

        onServiceDataLoaded() {
            window.addEventListener(
                UI_EVENTS.COMPANY_SERVICE_LOADED_EVENT,
                ({ detail }) => {
                    this.viewCompanyService(detail.data);
                },
            );
        },
    }));
});
