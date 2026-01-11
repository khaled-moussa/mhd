import { closeModal, showModal } from "./_modal";

export default function ModalHandler() {
    document.addEventListener("click", (event) => {
        const btn = event.target.closest(".modal-close");

        if (!btn) {
            return;
        }

        const modalId = btn.dataset.modalId;

        if (!modalId) {
            return;
        }

        closeModal({ modalId: modalId, withEvent: true });
    });

    document.addEventListener("click", (event) => {
        const btn = event.target.closest(".modal-open");

        if (!btn) {
            return;
        }

        const modalId = btn.dataset.modalId;

        if (!modalId) {
            return;
        }

        showModal({ modalId: modalId, withEvent: true });
    });
}
