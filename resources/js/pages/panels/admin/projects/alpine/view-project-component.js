import { showModal } from "@js/components/modal/_modal";
import { UI_EVENTS } from "@js/utils/enums";
import { MODALS } from "@js/utils/enums";
import initSplideCarousel   from "@js/common/carousel/_splide-carousel";
import MessageToast from "@js/utils/message-toast";

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
        |--------------------------------------------------------------------------
        | Public
        |--------------------------------------------------------------------------
        */
        async openProject(projectData) {
            if (!projectData) {
                return showError();
            }

            this.updateModalContent(projectData);
            this.initImages(projectData.images ?? []);
            showModal({ modalId: MODALS.VIEW_COMPANY_PROJECT_MODAL });
        },

        /*
        |--------------------------------------------------------------------------
        | Modal Content
        |--------------------------------------------------------------------------
        */

        updateModalContent(project) {
            this.setText("#projects-modal-title", project.title);
            this.setText("#projects-modal-description", project.description);
            this.setText("#project-delivered", project.delivered_at);
            this.setText("#project-price", project.price_start);
            this.setText("#project-address", project.address);
            this.setIframeSrc("#project-location", project.location);
        },

        /*
        |--------------------------------------------------------------------------
        | Images
        |--------------------------------------------------------------------------
        */

        initImages(images = []) {
            const splide = document.getElementById("project-modal-splide");

            if (!splide) return;

            splide.innerHTML = `
                <div class="splide__track">
                    <ul class="splide__list" id="projects-modal-carousel-list"></ul>
                </div>
            `;

            const list = document.getElementById("projects-modal-carousel-list",);

            if (!list) return;

            images.forEach((image) => {
                list.insertAdjacentHTML(
                    "beforeend",
                    `
                        <li class="splide__slide">
                            <div class="projects-modal-image">
                                <img src="${image.path}" alt="Project">
                            </div>
                        </li>
                    `,
                );
            });

            initSplideCarousel({ splideElementId: "#project-modal-splide" });
        },

        /* 
        |--------------------------------------------------------------------------
        | Events
        |-------------------------------------------------------------------------- 
        */

        registerListeners() {
            this.onProjectDataLoadedEvent();
        },

        onProjectDataLoadedEvent() {
            window.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_LOADED_EVENT, ({ detail }) => {
                    this.openProject(detail.data);
                },
            );
        },

        /*
        |--------------------------------------------------------------------------
        | Helpers
        |--------------------------------------------------------------------------
        */

        setText(selector, value = "") {
            const el = document.querySelector(selector);
            if (el) el.textContent = value;
        },

        setIframeSrc(selector, value = "") {
            const el = document.querySelector(selector);
            if (el && value) el.src = value;
        },

        showError() {
            MessageToast("error");
        },

        // downloadBrochure() {
        //     const brochure = this.projectData.brochure;

        //     if (!brochure || !brochure.url) {
        //         this.showError();
        //         return;
        //     }

        //     const button = this.$el;

        //     // UI state
        //     button.classList.add("spinner");
        //     button.disabled = true;

        //     const link = document.createElement("a");
        //     link.href = brochure.url;
        //     link.download = brochure.name;
        //     link.rel = "noopener";

        //     document.body.appendChild(link);
        //     link.click();
        //     document.body.removeChild(link);

        //     // Restore UI
        //     setTimeout(() => {
        //         button.classList.remove("spinner");
        //         button.disabled = false;
        //     }, 500);
        // },
    }));
});
