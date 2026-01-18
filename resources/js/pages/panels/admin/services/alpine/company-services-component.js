import MessageToast from "@js/utils/message-toast";
import { deleteModal } from "@js/components/modal/delete-modal";
import {
    dispatchModalOpenedEvent,
    showModal,
} from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";

document.addEventListener("alpine:init", () => {
    Alpine.data("companyServicesComponent", () => ({
        /* 
        |-------------------------------
        | State
        |------------------------------- 
        */
        canDelete: true,

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
        async viewCompanyService(companyServiceUuid) {
            if (!this.isValidUuid(companyServiceUuid)) {
                return this.showError();
            }

            this.toggleSpinner(true);

            await this.$wire.call("viewCompanyService", companyServiceUuid);

            showModal({
                modalId: MODALS.VIEW_COMPANY_SERVICE_MODAL,
                callback: () => this.toggleSpinner(false),
            });
        },

        editCompanyService(companyServiceUuid) {
            if (!this.isValidUuid(companyServiceUuid)) {
                return this.showError();
            }

            this.toggleSpinner(true);

            dispatchModalOpenedEvent(MODALS.UPDATE_COMPANY_SERVICE_MODAL, {
                companyServiceUuid,
                triggerEl: this.$el,
            });
        },

        deleteCompanyService(companyServiceUuid) {
            if (!this.canDelete) {
                return MessageToast("warning");
            }

            deleteModal({
                modalId: MODALS.DELETE_COMPANY_SERVICE_MODAL,
                closeAfterConfirm: true,
                onConfirm: () => this.confirmDelete(companyServiceUuid),
            });
        },

        async confirmDelete(companyServiceUuid) {
            if (!this.isValidUuid(companyServiceUuid)) {
                return this.showError();
            }

            this.canDelete = false;

            await this.$wire.call("deleteCompanyService", companyServiceUuid);
        },

        /* 
        |-------------------------------
        | Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_SERVICE_DELETED_EVENT,
                this.handleCompanyServiceDeleted.bind(this),
            );
        },

        handleCompanyServiceDeleted() {
            MessageToast("deleted");
            this.canDelete = true;
        },

        /* 
        |-------------------------------
        | Helpers
        |------------------------------- 
        */
        toggleSpinner(state) {
            this.$el.classList.toggle("spinner", state);
        },

        isValidUuid(uuid) {
            return Boolean(uuid);
        },

        showError() {
            MessageToast("error");
        },
    }));
});
