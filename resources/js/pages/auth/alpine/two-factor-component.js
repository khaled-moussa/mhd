import { FORMS, OTP_EVENTS, UI_EVENTS } from "@js/utils/enums";
/* 
|-----------------------------
| Alpine Component
|----------------------------- 
*/
document.addEventListener("alpine:init", () => {
    Alpine.data("twoFactorComponent", () => ({
        /* 
        |-----------------------------
        | State
        |----------------------------- 
        */
        submitBtnId: "#two-factor-submit-btn",
        submitBtnElement: null,

        /* 
        |-----------------------------
        | Init
        |----------------------------- 
        */
        init() {
            this.initElements();
            this.initEvents();
            this.initListeners();
        },

        initElements() {
            this.submitBtnElement = this.$el.querySelector(this.submitBtnId);
        },

        initEvents() {
            this.dispatchStartTimerEvent();
        },

        initListeners() {
            this.listenToResendOtpEvent();
            this.listenToTwoFactorSuccessEvent();
        },

        /* 
        |-----------------------------
        | Actions
        |----------------------------- 
        */
        resetComponent() {
            this.dispatchDestroyTimerEvent();
        },

        /* 
        |-----------------------------
        | Listeners
        |----------------------------- 
        */
        listenToResendOtpEvent() {
            window.addEventListener(OTP_EVENTS.RESEND_OTP_EVENT, () => {
                this.$wire.call("sendOtp");
                this.dispatchStartTimerEvent();
            });
        },

        listenToTwoFactorSuccessEvent() {
            this.$el.addEventListener(UI_EVENTS.TWO_FACTOR_SUCCESS_EVENT, () => {
                this.resetComponent();
            });
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
                            formId: FORMS.TWO_FACTOR_AUTH_FORM,
                        },
                    })
                );
            });
        },

        dispatchDestroyTimerEvent() {
            this.$nextTick(() => {
                window.dispatchEvent(
                    new CustomEvent(OTP_EVENTS.DESTROY_TIMER_EVENT)
                );
            });
        },
    }));
});