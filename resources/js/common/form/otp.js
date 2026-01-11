import { OTP_EVENTS } from "@js/utils/enums";

export default function otpInput(selector = ".otp-wrapper") {
    /*
    |------------------------------------
    |   DOM References
    |------------------------------------
    */
    const wrapper = document.querySelector(selector);

    if (!wrapper) {
        return;
    }

    const inputs = Array.from(wrapper.querySelectorAll(".otp-input-slot"));

    if (inputs.length === 0) {
        return;
    }

    /*
    |------------------------------------
    |   Helpers
    |------------------------------------
    */
    const getOtpValue = () => inputs.map((i) => i.value).join("");

    const dispatchOtpEvent = (value = null) => {
        window.dispatchEvent(
            new CustomEvent(OTP_EVENTS.OTP_INPUT_EVENT, {
                detail: value ? { otp: value } : null,
            }),
        );
    };

    const focusFirst = () => inputs[0].focus();

    /*
    |------------------------------------
    |   Register Input Events
    |------------------------------------
    */
    const registerEvents = () => {
        inputs.forEach((input, index) => {
            /*
            |-------------------------------------------
            |   Handle Typing
            |-------------------------------------------
            */
            input.addEventListener("input", () => {
                input.value = input.value.replace(/\D/g, "");

                if (input.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                const otpValue = getOtpValue();

                if (otpValue.length === inputs.length) {
                    dispatchOtpEvent(otpValue);
                }
            });

            /*
            |-------------------------------------------
            |   Handle Backspace
            |-------------------------------------------
            */
            input.addEventListener("keydown", (e) => {
                if (e.key === "Backspace") {
                    if (!input.value && index > 0) {
                        inputs[index - 1].focus();
                    }

                    dispatchOtpEvent();
                }
            });

            /*
            |-------------------------------------------
            |   Handle Pasting
            |-------------------------------------------
            */
            input.addEventListener("paste", (e) => {
                e.preventDefault();

                const pasteDigits = e.clipboardData
                    .getData("text")
                    .replace(/\D/g, "")
                    .slice(0, inputs.length);

                pasteDigits.split("").forEach((char, idx) => {
                    if (inputs[idx]) {
                        inputs[idx].value = char;
                    }
                });

                const lastIndex = Math.min(
                    pasteDigits.length - 1,
                    inputs.length - 1,
                );
                inputs[lastIndex]?.focus();

                if (pasteDigits.length === inputs.length) {
                    dispatchOtpEvent(pasteDigits);
                } else {
                    dispatchOtpEvent();
                }
            });
        });
    };

    /*
    |------------------------------------
    |   Reset Listener
    |------------------------------------
    */
    const registerResetListener = () => {
        window.addEventListener(OTP_EVENTS.RESET_OTP_INPUT_EVENT, () => {
            inputs.forEach((input) => (input.value = ""));
            focusFirst();
        });
    };

    /*
    |------------------------------------
    |   Init
    |------------------------------------
    */
    focusFirst();
    registerEvents();
    registerResetListener();
}
