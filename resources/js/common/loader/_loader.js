import initializeReveal from "@js/common/animation/reveal";

export default function initPageOnLoad() {
    const body = document.body;

    const run = () => {
        body.classList.add("overflow-hidden");

        setTimeout(() => {
            body.classList.remove("loader");
            body.classList.remove("overflow-hidden");

            initializeReveal();
        }, 1500);
    };

    // Initial page load
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", run);
    } else {
        run();
    }

    // Livewire support
    if (window.Livewire) {
        window.Livewire.hook("message.processed", () => {
            initializeReveal();
        });
    }
}