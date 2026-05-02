import { showModal }        from "@js/components/modal/_modal";
import { MODALS }           from "@js/utils/enums";
import initSplideCarousel   from "@js/common/carousel/_splide-carousel";
import MessageToast         from "@js/utils/message-toast";

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

window.openProject = function (projectData) {
    if (! projectData) {
        return showError();
    }

    updateModalContent(projectData);
    initImages(projectData.images ?? []);
    showModal({ modalId: MODALS.VIEW_COMPANY_PROJECT_MODAL });
};

/*
|--------------------------------------------------------------------------
| Modal Content
|--------------------------------------------------------------------------
*/

function updateModalContent(project) {
    setText('#projects-modal-title',       project.title);
    setText('#projects-modal-description', project.description);
    setText('#project-delivered',          project.delivered_at);
    setText('#project-price',              project.price_start);
    setText('#project-address',            project.address);
    setIframeSrc('#project-location',      project.location);
}

/*
|--------------------------------------------------------------------------
| Images
|--------------------------------------------------------------------------
*/

function initImages(images = []) {
    const splide = document.getElementById('project-modal-splide');

    if (! splide) return;

    splide.innerHTML = `
        <div class="splide__track">
            <ul class="splide__list" id="projects-modal-carousel-list"></ul>
        </div>
    `;

    const list = document.getElementById('projects-modal-carousel-list');

    if (! list) return;

    images.forEach((image) => {
        list.insertAdjacentHTML('beforeend', `
            <li class="splide__slide">
                <div class="projects-modal-image">
                    <img src="${image.path}" alt="Project">
                </div>
            </li>
        `);
    });

    initSplideCarousel({ splideElementId: '#project-modal-splide' });
}

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

function setText(selector, value = '') {
    const el = document.querySelector(selector);
    if (el) el.textContent = value;
}

function setIframeSrc(selector, value = '') {
    const el = document.querySelector(selector);
    if (el && value) el.src = value;
}

function showError() {
    MessageToast('error');
}