import MessageToast from "@js/utils/message-toast";
import resetFormValidation from "@js/utils/reset-form-validation";
import { FORMS, UI_EVENTS } from "@js/utils/enums";

document.addEventListener("alpine:init", () => {
    Alpine.data("createContactComponent", () => ({
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
            this.onContactCreatedEvent();
        },

        onContactCreatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.CONTACT_CREATED_EVENT,
                ({ detail }) => {
                    MessageToast("created", detail.message);
                    resetFormValidation(FORMS.CREATE_CONTACT_FORM);
                },
            );
        },
    }));
});
