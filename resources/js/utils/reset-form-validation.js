export default function resetFormValidation(formId) {
    const form = document.getElementById(formId);

    if (!form) {
        return;
    }

    // Reset form fields
    form.reset();

    // Clear validation messages
    form.querySelectorAll(".validation-msg").forEach(el => {
        el.textContent = "";
        el.classList.add('hidden!');
    });

    // Remove error styles
    form.querySelectorAll(".border-red-500, .ring-red-500").forEach(el => {
        el.classList.remove("border-red-500", "ring-red-500");
    });
}
