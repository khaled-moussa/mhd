import MicroModal from "micromodal";
import { config } from "@js/components/modal/_modal";

export default function initProjects() {
    const loadMoreBtn = document.getElementById("projects-load-more");
    const projectCards = document.querySelectorAll(".projects__card");

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
}

// -- Project modal
window.viewProject = (data) => {
    const modalId = "projects-modal";

    // Elements
    const titleEl = document.getElementById(`${modalId}-title`);
    const descEl = document.getElementById(`${modalId}-description`);
    const carouselList = document.getElementById("projects-modal-carousel-list");

    // Update text
    titleEl.textContent = data.title;
    descEl.textContent = data.description;

    // Clear old slides
    carouselList.innerHTML = "";

    // Add new slides
    const images = data.images || [data.img]; // fallback
    images.forEach((imgSrc) => {
        const slide = document.createElement("li");
        slide.className = "splide__slide";

        const img = document.createElement("img");
        img.src = `/assets/mockups/${imgSrc}`;
        img.alt = data.title;
        img.className = "projects__modal-img rounded-xl";

        slide.appendChild(img);
        carouselList.appendChild(slide);
    });

    // Show modal
    MicroModal.show(modalId, {
        ...config,
        onClose: () => {
            // Optional: clear slides on close
            carouselList.innerHTML = "";
            titleEl.textContent = "";
            descEl.textContent = "";
        },
    });
};
