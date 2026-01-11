// Fallback to empty object if JS_ENUMS is undefined
const ENUMS = window.__ENUMS__ ?? {};

// Destructure categorized enums
export const {
    OTP: {
        EVENTS: OTP_EVENTS = {},
        ERRORS: OTP_EXCEPTION = {},
        TIMER: OTP_TIMER = {},
    } = {},
    UI: {
        FORMS = {},
        MODALS = {},
        EVENTS: UI_EVENTS = {},
        LABELS: UI_LABELS = {},
        STEPS: UI_FORM_STEP = {},
    } = {},
} = ENUMS;

// You can use:
// OTP_EVENTS, OTP_ERRORS, OTP_TIMER
// FORMS, MODALS, UI_EVENTS
