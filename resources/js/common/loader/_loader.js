import initializeReveal from "../animation/reveal";

export default function initPageOnLoad() {
    const body = document.body;
    body.classList.add("overflow-hidden");

    window.onload = () => {
        setTimeout(() => {
            body.classList.remove("loader");
            body.classList.remove("overflow-hidden");

            initializeReveal();
        }, 2500);
    };
}
