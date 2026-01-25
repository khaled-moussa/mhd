import { showModal } from "@js/components/modal/_modal";
import { UI_EVENTS } from "@js/utils/enums";
import { MODALS } from "@js/utils/enums";
import initSplideCarousel from "@js/common/carousel/_splide-carousel";

document.addEventListener("alpine:init", () => {
    Alpine.data("projectViewComponent", () => ({
        /* 
        |-------------------------------
        | Init
        |------------------------------- 
        */
        projectData: [],
        splideElementId: "#project-modal-splide",

        /* 
        |-------------------------------
        | Init
        |------------------------------- 
        */
        init() {
            this.registerListeners();
        },

        /* 
        |-------------------------------
        | Actions
        |------------------------------- 
        */
        async openProject(projectData, triggerEl) {
            if (projectData.length === 0) {
                return this.showError();
            }

            this.projectData = projectData;

            // Init images carousel
            this.initImages(this.projectData.images);

            // Show modal
            showModal({
                modalId: MODALS.VIEW_COMPANY_PROJECT_MODAL,
            });
        },

        initImages(images) {
            this.$nextTick(() => {
                initSplideCarousel({
                    splideElementId: this.splideElementId,
                });
            });

            // Elements
            const carouselList = document.getElementById(
                "projects-modal-carousel-list",
            );

            // Clear old slides
            carouselList.innerHTML = "";

            // Add new slides
            images.forEach((img) => {
                const slide = document.createElement("li");
                slide.className = "splide__slide";

                const image = document.createElement("img");
                image.src = img.path;
                image.alt = "project";
                image.className = "projects__modal-image rounded-xl";

                slide.appendChild(image);
                carouselList.appendChild(slide);
            });
        },

        /* 
        |-------------------------------
        | Events
        |------------------------------- 
        */
        registerListeners() {
            this.onProjectDataLoadedEvent();
        },

        onProjectDataLoadedEvent() {
            window.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_LOADED_EVENT,
                ({ detail }) => {
                    this.openProject(detail.projectData);
                },
            );
        },
    }));
});
