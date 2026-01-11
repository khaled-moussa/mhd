import { closeModal, showModal } from "./_modal";

export function deleteModal(
    {
        modalId,
        onConfirm,
        closeAfterConfirm = true
    }
) {
    // Open modal manually
    showModal({ modalId: modalId });

    // Confirm button
    const confirmBtn = document.querySelector(`#${modalId} [data-confirm]`);

    if (confirmBtn) {
        // Remove old listeners to prevent duplicates
        confirmBtn.replaceWith(confirmBtn.cloneNode(true));

        const newConfirmBtn = document.querySelector(`#${modalId} [data-confirm]`);

        newConfirmBtn.addEventListener("click", () => {
            if (typeof onConfirm === "function") {
                onConfirm();

                if (closeAfterConfirm) {
                    closeModal({ modalId: modalId });
                }
            }
        });
    }
}
