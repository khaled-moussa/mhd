import { UI_EVENTS } from "@js/utils/enums";

export default function resetFormValidation(formId = null) {
    const resetForm = (id) => {
        const form = document.getElementById(id);

        if (!form) return;

        // Reset form fields
        form.reset();

        // Clear validation messages
        form.querySelectorAll(".validation-msg").forEach((el) => {
            el.textContent = "";
            el.classList.add("hidden");
        });

        // Remove validation styles
        form.querySelectorAll(".border-red-500, .ring-red-500").forEach(
            (el) => {
                el.classList.remove("border-red-500", "ring-red-500");
            },
        );
    };

    if (formId) {
        resetForm(formId);
    }

    window.addEventListener(UI_EVENTS.RESET_FORM_VALIDATION, ({ detail }) => {
        const formId = detail?.formId;
        
        if (!formId) return;

        resetForm(formId);
    });
}
