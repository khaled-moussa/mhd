import MessageToast from "@js/utils/message-toast";
import { UI_EVENTS } from "@js/utils/enums";

document.addEventListener("alpine:init", () => {
    Alpine.data("profileComponent", () => ({
        /* 
        |-------------------------------
        |   States
        |-------------------------------    
        */
        editing: false,
        canDelete: true,

        /* 
        |-------------------------------
        |   Init
        |------------------------------- 
        */
        init() {
            this.registerListeners();
        },

        /* 
        |-------------------------------
        |   Actions
        |------------------------------- 
        */
        editUser() {
            this.editing = true;
        },

        cancelEdit() {
            this.editing = false;
        },

        /* 
        |-------------------------------
        |   Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.listenToProfileUpdatedEvent();
        },

        listenToProfileUpdatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.USER_PROFILE_UPDATED_EVENT,
                () => {
                    MessageToast("updated");
                    this.cancelEdit();
                },
            );
        },
    }));
});
