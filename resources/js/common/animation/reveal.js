import ScrollReveal from "scrollreveal";

export default function initializeReveal() {
    ScrollReveal().reveal(".reveal", {
        distance: "100px",
        duration: 1250,
        easing: "ease-in-out",
        origin: "bottom",
        interval: 200,
        opacity: 0,
        desktop: true,
        mobile: true,
    });
}
