import MessageToast from "@js/utils/message-toast";
import { closeModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";

document.addEventListener("alpine:init", () => {
    Alpine.data("companyProjectFormCreateComponent", () => ({
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
            this.listenToCompanyProjectCreatedEvent();
        },

        listenToCompanyProjectCreatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_CREATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.CREATE_COMPANY_PROJECT_MODAL,
                    });
                    MessageToast("created");
                },
            );
        },
    }));
});
