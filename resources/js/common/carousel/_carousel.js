import Splide from "@splidejs/splide";

export default function initSplideCarousel() {
    const splideElement = document.querySelector("#splide");

    if (!splideElement) {
        return;
    }

    const slidesCount = splideElement.querySelectorAll(".splide__slide").length;
    
    if (splideElement && slidesCount != 0) {
        let options = {
            perPage: 1,
            rewind: true,
            autoWidth: false,
            autoHeight: false,   
            pagination: false,
            breakpoints: {
                640: {
                    // sm screens
                    gap: slidesCount === 1 ? "0.5rem" : "1rem",
                    focus: slidesCount === 1 ? "center" : "start",
                },
                1024: {
                    // md-lg screens
                    gap: slidesCount === 1 ? "1rem" : "1.5rem",
                    focus: slidesCount === 1 ? "center" : "start",
                },
                1280: {
                    // xl+
                    gap: slidesCount === 1 ? "1rem" : "2rem",
                    focus: slidesCount === 1 ? "center" : "start",
                },
            },
        };

        // Default (desktop)
        if (slidesCount === 1) {
            options.focus = "center";
            options.gap = "1rem";
        } else {
            options.focus = "start";
            options.gap = "2rem";
        }

        new Splide("#splide", options).mount();
    }
}
