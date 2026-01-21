import { showModal } from "@js/components/modal/_modal";
import { MODALS } from "@js/utils/enums";
import initSplideCarousel from "@js/common/carousel/_carousel";

document.addEventListener("alpine:init", () => {
    Alpine.data("projectViewComponent", () => ({
        /* 
        |-------------------------------
        | Properties
        |------------------------------- 
        */
        isOpen: false,

        project: {
            title: "",
            description: "",
            images: [],
        },

        /* 
        |-------------------------------
        | Init
        |------------------------------- 
        */
        init() {},

        /* 
        |-------------------------------
        | Actions
        |------------------------------- 
        */
        openProject(project) {
            const modalId = "projects-modal";
            const splideElementId = "#project-modal-splide";

            this.$nextTick(() => {
                initSplideCarousel({ splideElementId: splideElementId });
            });

            // Elements
            const titleEl = document.getElementById(`${modalId}-title`);
            const descEl = document.getElementById(`${modalId}-description`);
            const carouselList = document.getElementById(
                "projects-modal-carousel-list",
            );

            // Update text
            titleEl.textContent = project.title;
            descEl.textContent = project.description;

            // Clear old slides
            carouselList.innerHTML = "";

            // Add new slides
            const images = project.images || [project.img]; // fallback

            images.forEach((img) => {
                const slide = document.createElement("li");
                slide.className = "splide__slide";

                const image = document.createElement("img");
                image.src = img.path;
                image.alt = project.title;
                image.className = "projects__modal-img rounded-xl";

                slide.appendChild(image);
                carouselList.appendChild(slide);
            });

            // Show modal
            showModal({
                modalId: modalId,
                callback: () => this.reset(),
            });
        },

        /* 
        |-------------------------------
        | Helpers
        |------------------------------- 
        */
        reset() {
            this.project = {
                title: "",
                description: "",
                images: [],
            };
        },
    }));
});
