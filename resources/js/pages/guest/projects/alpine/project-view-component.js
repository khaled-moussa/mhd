import { showModal } from "@js/components/modal/_modal";
import { UI_EVENTS } from "@js/utils/enums";
import { MODALS } from "@js/utils/enums";
import initSplideCarousel from "@js/common/carousel/_splide-carousel";
import MessageToast from "../../../../utils/message-toast";

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
        async openProject(projectData) {
            if (projectData.length === 0) {
                return this.showError();
            }

            if (projectData.url || projectData.images.length === 0) {
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

        downloadBrochure() {
            const brochure = this.projectData.brochure;

            if (!brochure || !brochure.url) {
                this.showError();
                return;
            }

            const button = this.$el;

            // UI state
            button.classList.add("spinner");
            button.disabled = true;

            const link = document.createElement("a");
            link.href = brochure.url;
            link.download = brochure.name;
            link.rel = "noopener";

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Restore UI
            setTimeout(() => {
                button.classList.remove("spinner");
                button.disabled = false;
            }, 500);
        },

        initImages(images) {
            const carouselList = document.getElementById(
                "projects-modal-carousel-list",
            );

            // Clear old slides
            carouselList.innerHTML = "";

            // Add new slides FIRST before initializing Splide
            images.forEach((img) => {
                const slide = document.createElement("li");
                slide.className = "splide__slide";

                // Wrapper div — keeps h-full chain intact for object-fit to work
                const wrapper = document.createElement("div");
                wrapper.className = "projects__modal-image";

                const image = document.createElement("img");
                image.src = img.path;
                image.alt = "project";

                wrapper.appendChild(image);
                slide.appendChild(wrapper);
                carouselList.appendChild(slide);
            });

            // Init Splide AFTER slides are in the DOM
            this.$nextTick(() => {
                initSplideCarousel({
                    splideElementId: this.splideElementId,
                });
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

        /* 
        |-------------------------------
        | Helpers
        |------------------------------- 
        */
        showError() {
            MessageToast("error");
        },
    }));
});
