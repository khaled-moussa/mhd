import MessageToast from "@js/utils/message-toast";
import { closeModal, showModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";

document.addEventListener("alpine:init", () => {
    Alpine.data("companyProjectFormUpdateComponent", () => ({
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
        async editCompanyProject(companyProjectUuid, triggerEl) {
            if (!this.isValidPayload(companyProjectUuid, triggerEl)) {
                return this.showError();
            }

            await this.$wire.call("editCompanyProject", companyProjectUuid);

            showModal({
                modalId: MODALS.UPDATE_COMPANY_PROJECT_MODAL,
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
            this.listenToCompanyProjectUpdated();
        },

        listenToModalOpened() {
            window.addEventListener(
                MODALS_EVENT.opened(MODALS.UPDATE_COMPANY_PROJECT_MODAL),
                ({ detail }) => {
                    const { companyProjectUuid, triggerEl } = detail ?? {};

                    this.editCompanyProject(companyProjectUuid, triggerEl);
                },
            );
        },

        listenToCompanyProjectUpdated() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_UPDATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.UPDATE_COMPANY_PROJECT_MODAL,
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
        isValidPayload(companyProjectUuid, triggerEl) {
            return Boolean(companyProjectUuid && triggerEl);
        },

        showError() {
            MessageToast("error");
        },
    }));
});
