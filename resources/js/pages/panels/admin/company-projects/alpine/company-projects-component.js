import MessageToast from "@js/utils/message-toast";
import { deleteModal } from "@js/components/modal/delete-modal";
import {
    dispatchModalOpenedEvent,
    showModal,
} from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";

document.addEventListener("alpine:init", () => {
    Alpine.data("companyProjectsComponent", () => ({
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
        async viewCompanyProject(companyProjectUuid) {
            if (!this.isValidUuid(companyProjectUuid)) {
                return this.showError();
            }

            this.toggleSpinner(true);

            await this.$wire.call("viewCompanyProject", companyProjectUuid);

            showModal({
                modalId: MODALS.VIEW_COMPANY_PROJECT_MODAL,
                callback: () => this.toggleSpinner(false),
            });
        },

        editCompanyProject(companyProjectUuid) {
            if (!this.isValidUuid(companyProjectUuid)) {
                return this.showError();
            }

            this.toggleSpinner(true);

            dispatchModalOpenedEvent(MODALS.UPDATE_COMPANY_PROJECT_MODAL, {
                companyProjectUuid,
                triggerEl: this.$el,
            });
        },

        deleteCompanyProject(companyProjectUuid) {
            if (!this.canDelete) {
                return MessageToast("warning");
            }

            deleteModal({
                modalId: MODALS.DELETE_COMPANY_PROJECT_MODAL,
                closeAfterConfirm: true,
                onConfirm: () => this.confirmDelete(companyProjectUuid),
            });
        },

        async confirmDelete(companyProjectUuid) {
            if (!this.isValidUuid(companyProjectUuid)) {
                return this.showError();
            }

            this.canDelete = false;

            await this.$wire.call("deleteCompanyProject", companyProjectUuid);
        },

        /* 
        |-------------------------------
        | Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_DELETED_EVENT,
                this.handleCompanyProjectDeleted.bind(this),
            );
        },

        handleCompanyProjectDeleted() {
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
