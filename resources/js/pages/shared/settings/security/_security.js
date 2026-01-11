// Extenral Scripts
import showPassword from "@js/common/form/password.js";
import ModalHandler from "@js/components/modal/modal-handler.js";

// Alpine Scripts
import "./alpine/forms/update-email-form-component.js";
import "./alpine/forms/update-password-form-component.js";
import "./alpine/forms/update-two-factor-form-component.js";
import "./alpine/forms/delete-account-form-component.js";

// Common Components
import '@js/components/otp/_otp.js';

// Run Imports
showPassword();
ModalHandler();