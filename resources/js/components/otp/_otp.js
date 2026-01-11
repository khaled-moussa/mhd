import { OTP_EVENTS, OTP_EXCEPTION, OTP_TIMER } from "../../utils/enums";
import MessageToast from "../../utils/message-toast";
import resetFormValidation from "../../utils/reset-form-validation";
import { closeModal } from "../modal/_modal";
import otpInput from "@js/common/form/otp.js";

/* 
| -----------------------------
| Alpine Component
|----------------------------- 
*/
document.addEventListener("alpine:init", () => {
    Alpine.data("otpComponent", () => ({
        /* 
        | -----------------------------
        | State
        |----------------------------- 
        */
        otpCode: "",
        resendLocked: false,
        timer: null,
        seconds: null,
        modalId: null,
        formId: null,
        otpCodeInputElement: null,
        disableResendButton: true,

        /* 
        |-----------------------------
        | Init
        |-----------------------------
        */
        init() {
            otpInput();
            this.resetTimer();
            this.initElements();
            this.initListeners();
        },

        initElements() {
            this.otpCodeInputElement = this.$el.querySelector("#otp-input");
        },

        initListeners() {
            this.listenToStartTimerEvent();
            this.listenToDestroyTimerEvent();
            this.listenToOtpInputEvent();
            this.listenToOtpErrorEvent();
        },

        /* 
        |-----------------------------
        | Actions
        |----------------------------- 
        */
        startTimer(initialSeconds) {
            this.clearTimer();
            this.toggleResendButton(false);
            resetFormValidation(this.formId);

            this.seconds = initialSeconds ?? OTP_TIMER.DEFAULT_SECONDS;

            this.timer = setInterval(() => {
                if (this.seconds > 0) {
                    this.seconds--;
                    return;
                }
                this.resetTimer();
            }, 1000);
        },

        clearTimer() {
            clearInterval(this.timer);
            this.timer = null;
            this.seconds = null;
        },

        resetTimer() {
            this.clearTimer();
            this.resendLocked = false;
            this.toggleResendButton(true);
            resetFormValidation(this.formId);
        },

        validateOtp() {
            return /^\d{4}$/.test(this.otpCode);
        },

        setOtpCode() {
            if (!this.validateOtp() || !this.otpCodeInputElement) {
                return;
            }

            this.otpCodeInputElement.value = this.otpCode;
            this.otpCodeInputElement.dispatchEvent(new Event("input", { bubbles: true }));
        },

        destroy() {
            this.clearTimer();
            
            this.resendLocked = false;
            this.otpCode = "";

            this.toggleResendButton(false);
            this.dispatchResetOtpInput();

            resetFormValidation(this.formId);
        },

        resendLimitExceed() {
            this.clearTimer();
            this.resendLocked = true;
            this.startTimer(OTP_TIMER.RESEND_LIMIT_SECONDS);
        },

        resendOtp() {
            if (!this.resendLocked) {
                this.dispatchResendOtpEvent();
            }
        },

        /* 
        |-----------------------------
        | UI Helpers
        |----------------------------- 
        */
        get formattedTime() {
            if (!this.seconds) {
                return "";
            }

            const minutes = Math.floor(this.seconds / 60);
            const seconds = String(this.seconds % 60).padStart(2, "0");

            return `${minutes}:${seconds} to resend again`;
        },

        toggleResendButton(enable) {
            this.disableResendButton = !enable;
        },

        /* 
        |-----------------------------
        | Listeners
        |----------------------------- 
        */
        listenToStartTimerEvent() {
            window.addEventListener(OTP_EVENTS.START_TIMER_EVENT, ({ detail }) => {
                this.modalId = detail?.modalId ?? null;
                this.formId = detail?.formId ?? null;
                this.startTimer(detail?.initialSeconds);
            });
        },

        listenToDestroyTimerEvent() {
            window.addEventListener(OTP_EVENTS.DESTROY_TIMER_EVENT, () => this.destroy());
        },

        listenToOtpInputEvent() {
            window.addEventListener(OTP_EVENTS.OTP_INPUT_EVENT, ({ detail }) => {
                this.otpCode = detail?.otp?.trim() ?? "";
                this.setOtpCode();
            });
        },

        listenToOtpErrorEvent() {
            window.addEventListener(OTP_EVENTS.OTP_ERROR_EVENT, ({ detail }) => {
                const exception = detail?.exception;
                const message = detail?.message;

                switch (exception) {
                    case OTP_EXCEPTION.RESEND_LIMIT:
                        this.resendLimitExceed();
                        break;

                    case OTP_EXCEPTION.VERIFY_LIMIT:
                        MessageToast("warning", message);
                        closeModal({ modalId: this.modalId, withEvent: true });
                        break;

                    default:
                        break;
                }
            });
        },

        /* 
        |-----------------------------
        | Events
        |----------------------------- 
        */
        dispatchResendOtpEvent() {
            window.dispatchEvent(new CustomEvent(OTP_EVENTS.RESEND_OTP_EVENT));
        },

        dispatchResetOtpInput() {
            window.dispatchEvent(new CustomEvent(OTP_EVENTS.RESET_OTP_INPUT_EVENT));
        },
    }));
});
