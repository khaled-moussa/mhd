import { showModal }          from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS }  from "@js/utils/enums";
import initSplideCarousel     from "@js/common/carousel/_splide-carousel";
import MessageToast           from "@js/utils/message-toast";

document.addEventListener("alpine:init", () => {
    Alpine.data("projectViewComponent", () => ({
        /*
        |--------------------------------------------------------------------------
        | State
        |--------------------------------------------------------------------------
        */

        projectData: null,
        splideElementId: "#project-modal-splide",

        /*
        |--------------------------------------------------------------------------
        | Init
        |--------------------------------------------------------------------------
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
                return this.showError();
            }

            this.projectData = projectData;

            this.updateModalContent(projectData);
            this.initImages(projectData.images ?? []);

            showModal({
                modalId: MODALS.VIEW_COMPANY_PROJECT_MODAL,
            });
        },

        downloadBrochure(buttonElement) {
            const brochure = this.projectData?.brochure;

            if (!brochure?.url) {
                return this.showError();
            }

            // Loading state
            buttonElement.classList.add("spinner");
            buttonElement.disabled = true;

            const link = document.createElement("a");

            link.href = brochure.url;
            link.download = brochure.name ?? "brochure";
            link.rel = "noopener";

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Restore button state
            setTimeout(() => {
                buttonElement.classList.remove("spinner");
                buttonElement.disabled = false;
            }, 500);
        },

        /*
        |--------------------------------------------------------------------------
        | Modal Content
        |--------------------------------------------------------------------------
        */

        updateModalContent(project) {
            this.setText(
                "#projects-modal-title",
                project.title,
            );

            this.setText(
                "#projects-modal-description",
                project.description,
            );

            this.setText(
                "#project-delivered",
                project.delivered_at,
            );

            this.setText(
                "#project-price",
                project.price_start,
            );

            this.setText(
                "#project-address",
                project.address,
            );

            this.setIframeSrc(
                "#project-location",
                project.location,
            );
        },

        /*
        |--------------------------------------------------------------------------
        | Images
        |--------------------------------------------------------------------------
        */

        initImages(images = []) {
            const splide = document.getElementById(
                "project-modal-splide",
            );

            if (!splide) {
                return;
            }

            splide.innerHTML = `
                <div class="splide__track">
                    <ul
                        class="splide__list"
                        id="projects-modal-carousel-list"
                    ></ul>
                </div>
            `;

            const list = document.getElementById(
                "projects-modal-carousel-list",
            );

            if (!list) {
                return;
            }

            images.forEach((image) => {
                list.insertAdjacentHTML(
                    "beforeend",
                    `
                        <li class="splide__slide">
                            <div class="projects-modal-image">
                                <img
                                    src="${image.path}"
                                    alt="Project"
                                >
                            </div>
                        </li>
                    `,
                );
            });

            initSplideCarousel({
                splideElementId: this.splideElementId,
            });
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
                UI_EVENTS.COMPANY_PROJECT_LOADED_EVENT,
                ({ detail }) => {
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
            const element = document.querySelector(selector);

            if (!element) {
                return;
            }

            element.textContent = value;
        },

        setIframeSrc(selector, value = "") {
            const iframe = document.querySelector(selector);

            const emptyState = document.querySelector(
                "#project-location-empty",
            );

            if (!iframe) {
                return;
            }

            if (!value) {
                iframe.removeAttribute("src");
                iframe.style.display = "none";

                if (emptyState) {
                    emptyState.style.display = "flex";
                }

                return;
            }

            iframe.src = value;
            iframe.style.display = "block";

            if (emptyState) {
                emptyState.style.display = "none";
            }
        },

        showError() {
            MessageToast("error");
        },
    }));
});