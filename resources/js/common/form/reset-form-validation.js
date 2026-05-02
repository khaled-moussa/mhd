export default function resetFormValidation() {
    document.addEventListener('submit', (e) => {
        const form = e.target;

        if (!(form instanceof HTMLFormElement)) return;

        form.querySelectorAll('.validation-msg').forEach((el) => {
            el.textContent = '';
            el.classList.add('hidden');
        });

        form.querySelectorAll('.border-red-500, .ring-red-500').forEach((el) => {
            el.classList.remove('border-red-500', 'ring-red-500');
        });
    });
}