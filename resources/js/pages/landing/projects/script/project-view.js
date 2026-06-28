import { showModal } from "@js/components/modal/_modal";
import { MODALS } from "@js/utils/enums";
import initSplideCarousel from "@js/common/carousel/_splide-carousel";
import MessageToast from "@js/utils/message-toast";

/*
|--------------------------------------------------------------------------
| State
|--------------------------------------------------------------------------
*/

let activeProject = null;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

window.openProject = function (projectData) {
    if (!projectData) {
        return showError();
    }

    activeProject = projectData;

    updateModalContent(projectData);
    initImages(projectData.images ?? []);

    // Hide/show download button based on brochure
    const downloadBtn = document.getElementById("brochure-btn");

    if (downloadBtn) {
        downloadBtn.style.display = projectData.brochure?.url ? "flex" : "none";
    }

    showModal({
        modalId: MODALS.VIEW_COMPANY_PROJECT_MODAL,
    });
};

window.downloadProjectBrochure = function (event) {
    const brochure = activeProject?.brochure;
    const downloadButton = event.target;

    if (!brochure?.url) {
        return showError();
    }

    downloadButton.classList.add("spinner");
    downloadButton.disabled = false;

    const link = document.createElement("a");

    link.href = brochure.url;
    link.download = brochure.name ?? "brochure";
    link.rel = "noopener";

    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    // Restore button state
    setTimeout(() => {
        downloadButton.classList.remove("spinner");
        downloadButton.disabled = false;
    }, 500);
};

/*
|--------------------------------------------------------------------------
| Modal Content
|--------------------------------------------------------------------------
*/

function updateModalContent(project) {
    setText("#projects-modal-title", project.title);

    setText("#projects-modal-description", project.description);

    setText("#project-delivered", project.delivered_at);

    setText("#project-price", project.price_start);

    setText("#project-address", project.address);

    setIframeSrc("#project-location", project.location);
}

/*
|--------------------------------------------------------------------------
| Images
|--------------------------------------------------------------------------
*/

function initImages(images = []) {
    const splide = document.getElementById("project-modal-splide");

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

    const list = document.getElementById("projects-modal-carousel-list");

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
        splideElementId: "#project-modal-splide",
    });
}

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

function setText(selector, value = null) {
    const element = document.querySelector(selector);

    if (!element) {
        return;
    }

    element.textContent = value ?? "—";
}

function setIframeSrc(selector, value = "") {
    const iframe = document.querySelector(selector);

    const emptyState = document.querySelector("#project-location-empty");

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
}

function showError() {
    MessageToast("error");
}
