import MessageToast from "@js/utils/message-toast";
import { deleteModal } from "@js/components/modal/delete-modal";
import { showModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";

document.addEventListener("alpine:init", () => {
    Alpine.data("contactsComponent", () => ({
        /* 
        |-------------------------------
        | State
        |-------------------------------
        */
        contactData: [],
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
        async viewContact(contactUuid) {
            if (!this.isValidUuid(contactUuid)) {
                return this.showError();
            }

            this.toggleSpinner(true);

            await this.$wire.call("viewContact", contactUuid);

            this.contactData = [];
        },

        deleteContact(contactUuid) {
            
            if (!this.canDelete) {
                return MessageToast("warning");
            }

            deleteModal({
                modalId: MODALS.DELETE_CONTACT_MODAL,
                closeAfterConfirm: true,
                onConfirm: () => this.confirmDelete(contactUuid),
            });
        },

        async confirmDelete(contactUuid) {
            if (!this.isValidUuid(contactUuid)) {
                return this.showError();
            }

            this.canDelete = false;

            await this.$wire.call("deleteContact", contactUuid);
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

        /* 
        |-------------------------------
        | Listeners
        |-------------------------------
        */
        registerListeners() {
            this.onContactDataLoaded();
            this.onContactDeleted();
        },

        onContactDataLoaded() {
            this.$el.addEventListener(
                UI_EVENTS.CONTACT_LOADED_EVENT,
                ({ detail }) => {
                    const contactData = detail.data;

                    if (contactData.length === 0) {
                        return;
                    }

                    this.contactData = contactData;

                    showModal({
                        modalId: MODALS.VIEW_CONTACT_MODAL,
                        callback: () => this.toggleSpinner(false),
                    });
                },
            );
        },

        onContactDeleted() {
            this.$el.addEventListener(
                UI_EVENTS.CONTACT_REQUEST_DELETED_EVENT,
                () => {
                    this.canDelete = true;
                    MessageToast("deleted");
                },
            );
        },
    }));
});
