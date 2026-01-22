import MessageToast from "@js/utils/message-toast";
import { showModal } from "@js/components/modal/_modal";
import { MODALS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { UI_EVENTS } from "../../../../../utils/enums";
import initSplideCarousel from "@js/common/carousel/_splide-carousel";

document.addEventListener("alpine:init", () => {
    Alpine.data("projectViewComponent", () => ({
        /* 
        |-------------------------------
        | State
        |------------------------------- 
        */
        projectData: [],

        splideElementId: "#admin-project-view-splide",

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
        | Syncing
        |------------------------------- 
        */
        async viewCompanyProject(projectUuid, triggerEl) {
            if (!projectUuid || !triggerEl) {
                MessageToast("error");
                return;
            }

            await this.$wire.call("viewCompanyProject", projectUuid);

            triggerEl.classList.remove("spinner");
        },

        async openProject() {
            if (!this.projectData.length === 0) {
                MessageToast("error");
                return;
            }

            this.$nextTick(() =>
                initSplideCarousel({
                    splideElementId: this.splideElementId,
                }),
            );

            showModal({
                modalId: MODALS.VIEW_COMPANY_PROJECT_MODAL,
            });
        },

        /* 
        |-------------------------------
        | Events
        |------------------------------- 
        */
        registerListeners() {
            this.onModalOpenEvent();
            this.onProjectLoadedDataEvent();
        },

        onModalOpenEvent() {
            window.addEventListener(
                MODALS_EVENT.opened(MODALS.VIEW_COMPANY_PROJECT_MODAL),
                ({ detail }) => {
                    this.viewCompanyProject(
                        detail.companyProjectUuid,
                        detail.triggerEl,
                    );
                },
            );
        },

        onProjectLoadedDataEvent() {
            window.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_LOADED_EVENT,
                ({ detail }) => {
                    this.projectData = detail.projectData;
                    this.openProject();
                },
            );
        },
    }));
});
