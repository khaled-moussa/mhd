import MessageToast from "@js/utils/message-toast";
import { closeModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";

document.addEventListener("alpine:init", () => {
    Alpine.data("companyServiceFormCreateComponent", () => ({
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
            this.listenToCompanyServiceCreatedEvent();
        },

        listenToCompanyServiceCreatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_SERVICE_CREATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.CREATE_COMPANY_SERVICE_MODAL,
                    });
                    MessageToast("created");
                },
            );
        },
    }));
});
