import MessageToast from "@js/utils/message-toast";
import {
    FORMS,
    MODALS,
    OTP_EVENTS,
    UI_EVENTS,
    UI_LABELS,
    UI_FORM_STEP,
} from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { closeModal } from "@js/components/modal/_modal";

/* 
|-----------------------------
| Constants
|----------------------------- 
*/
const STEP_LABELS = {
    [UI_FORM_STEP.PASSWORD_STEP]: UI_LABELS.PASSWORD_STEP,
    [UI_FORM_STEP.OTP_STEP]: UI_LABELS.VERIFY_CODE,
};

/* 
|-----------------------------
| Alpine Component
|----------------------------- 
*/
document.addEventListener("alpine:init", () => {
    Alpine.data("deleteAccountFormComponent", () => ({
        /* 
        |-----------------------------
        | State
        |----------------------------- 
        */
        step: UI_FORM_STEP.PASSWORD_STEP,
        submitBtnId: "#submit-delete-account-btn",
        submitBtnElement: null,

        /* 
        |-----------------------------
        | Init
        |----------------------------- 
        */
        init() {
            this.initState();
            this.initElements();
            this.initWatchers();
            this.registerListeners();
        },

        initState() {
            this.step =
                this.$wire.get("form.step") ?? UI_FORM_STEP.PASSWORD_STEP;
        },

        initElements() {
            this.submitBtnElement = this.$el.querySelector(this.submitBtnId);
        },

        initWatchers() {
            this.watchStepChanges();
        },

        /* 
        |-----------------------------
        | Watchers
        |----------------------------- 
        */
        watchStepChanges() {
            this.$watch("step", (step) => {
                this.updateSubmitLabel(step);

                if (step === UI_FORM_STEP.OTP_STEP) {
                    this.dispatchStartTimerEvent();
                }
            });
        },

        /* 
        |-----------------------------
        | UI
        |----------------------------- 
        */
        updateSubmitLabel(step) {
            if (!this.submitBtnElement) {
                return;
            }
            this.submitBtnElement.textContent = STEP_LABELS[step];
        },

        /* 
        |-----------------------------
        | Actions
        |----------------------------- 
        */
        resetComponent() {
            this.initState();
            this.dispatchDestroyTimerEvent();
        },

        /* 
        |-----------------------------
        | Listeners
        |----------------------------- 
        */
        registerListeners() {
            this.listenToStepNextEvent();
            this.listenToResendOtpEvent();
            this.listenToUserEmailUpdatedEvent();
            this.listenToModalClosedEvent();
        },

        listenToStepNextEvent() {
            this.$el.addEventListener(
                UI_EVENTS.STEP_NEXT_EVENT,
                ({ detail }) => {
                    this.step = detail?.step ?? UI_FORM_STEP.PASSWORD_STEP;
                },
            );
        },

        listenToResendOtpEvent() {
            window.addEventListener(OTP_EVENTS.RESEND_OTP_EVENT, () => {
                this.$wire.call("sendOtp");
                this.dispatchStartTimerEvent();
            });
        },

        listenToUserEmailUpdatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.USER_ACCOUNT_DELETED_EVENT,
                ({ detail }) => {
                    MessageToast("updated", detail?.message);
                    this.resetComponent();
                },
            );
        },

        listenToModalClosedEvent() {
            window.addEventListener(
                MODALS_EVENT.closed(MODALS.DELETE_ACCOUNT_MODAL),
                () => {
                    if (this.step === UI_FORM_STEP.PASSWORD_STEP) {
                        return;
                    }

                    this.$wire.call("resetForm");
                    this.resetComponent();
                },
            );
        },

        /* 
        |-----------------------------
        | Events
        |-----------------------------
        */
        dispatchStartTimerEvent() {
            this.$nextTick(() => {
                window.dispatchEvent(
                    new CustomEvent(OTP_EVENTS.START_TIMER_EVENT, {
                        detail: {
                            modalId: MODALS.DELETE_ACCOUNT_MODAL,
                            formId: FORMS.DELETE_ACCOUNT_FORM,
                        },
                    }),
                );
            });
        },

        dispatchDestroyTimerEvent() {
            this.$nextTick(() => {
                window.dispatchEvent(
                    new CustomEvent(OTP_EVENTS.DESTROY_TIMER_EVENT),
                );
            });
        },
    }));
});
