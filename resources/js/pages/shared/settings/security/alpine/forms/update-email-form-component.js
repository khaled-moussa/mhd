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
    [UI_FORM_STEP.EMAIL_STEP]: UI_LABELS.UPDATE_EMAIL,
    [UI_FORM_STEP.OTP_STEP]: UI_LABELS.VERIFY_CODE,
};

/* 
|-----------------------------
| Alpine Component
|----------------------------- 
*/
document.addEventListener("alpine:init", () => {
    Alpine.data("updateEmailFormComponent", () => ({
        /* 
        |-----------------------------
        | State
        |----------------------------- 
        */
        step: UI_FORM_STEP.PASSWORD_STEP,
        submitBtnId: "#submit-update-email-btn",
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
                UI_EVENTS.USER_EMAIL_UPDATED_EVENT,
                ({ detail }) => {
                    MessageToast("updated", detail?.message);
                    closeModal({ modalId: MODALS.UPDATE_EMAIL_MODAL });

                    this.resetComponent();
                },
            );
        },

        listenToModalClosedEvent() {
            window.addEventListener(
                MODALS_EVENT.closed(MODALS.UPDATE_EMAIL_MODAL),
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
        |----------------------------- c  
        */
        dispatchStartTimerEvent() {
            this.$nextTick(() => {
                window.dispatchEvent(
                    new CustomEvent(OTP_EVENTS.START_TIMER_EVENT, {
                        detail: {
                            modalId: MODALS.UPDATE_EMAIL_MODAL,
                            formId: FORMS.UPDATE_EMAIL_FORM,
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
