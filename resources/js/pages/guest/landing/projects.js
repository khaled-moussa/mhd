import MicroModal from "micromodal";
import { config } from "@js/components/modal/_modal";

export default function initProjects() {
    const loadMoreBtn = document.getElementById("load-more-btn");
    const projectCards = document.querySelectorAll(".project-card");

    let visibleCount = 3; // show first 3
    const step = 3; // load 3 each time

    // Initially hide all after first 3
    projectCards.forEach((card, index) => {
        if (index >= visibleCount) {
            card.classList.add("hidden");
        }
    });

    loadMoreBtn.addEventListener("click", () => {
        // Increase visible count
        visibleCount += step;

        projectCards.forEach((card, index) => {
            if (index < visibleCount) {
                card.classList.remove("hidden");
            }
        });

        // Hide button if no more hidden cards
        if (visibleCount >= projectCards.length) {
            loadMoreBtn.style.display = "none";
        }
    });
};

// -- Project modal
window.openProject = (data) => {
    const modalId = "open-project-modal";

    const img = data.img;
    const title = data.title;
    const description = data.description;

    const titleElement = document.getElementById("project-modal-title");
    const descriptionElement = document.getElementById(
        "project-modal-description",
    );

    MicroModal.show(modalId, {
        ...config,

        onShow: (modal) => {
            // Update modal content
            titleElement.textContent = title;
            descriptionElement.textContent = description;
        },

        onClose: (modal) => {
            titleElement.textContent = "";
            descriptionElement.textContent = "";
        },
    });
};
