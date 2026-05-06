window.addEventListener("message", ({ data: event = {} }) => {
    const { type, data } = event;

    if (type !== "site-editor-preview" || !data) return;

    const sections = Object.values(data)
        .filter((section) => section.order !== undefined)
        .sort((a, b) => a.order - b.order);

    sections.forEach((section) => {
        const el = document.querySelector(`#${section.key}`);
        if (!el) return;

        reorderSection(el);
        toggleVisibility(el, section.visible);

        // Stop if hidden
        if (section.visible === false) return;

        updateGenericContent(el, section);
        handleSpecialSections(el, section);
    });
});

/*
|--------------------------------------------------------------------------
| Core Helpers
|--------------------------------------------------------------------------
*/

/**
 * Reorder section in DOM
 */
function reorderSection(el) {
    el.parentElement?.appendChild(el);
}

/**
 * Toggle visibility
 */
function toggleVisibility(el, visible) {
    el.classList.toggle("!hidden", visible === false);
}

/**
 * Update generic title/description (safe)
 */
function updateGenericContent(el, section) {
    const title = el.querySelector(".section-title");
    const description = el.querySelector(".section-description");

    if (title && section.title !== undefined) {
        title.textContent = section.title;
    }

    if (description && section.description !== undefined) {
        description.textContent = section.description;
    }
}

/*
|--------------------------------------------------------------------------
| Section Router 
|--------------------------------------------------------------------------
*/

function handleSpecialSections(el, section) {
    switch (section.key) {
        case "hero":
            updateHero(el, section.data);
            break;

        case "footer":
            updateFooterSocials(el, section.data?.socials ?? []);
            break;
    }
}

/*
|--------------------------------------------------------------------------
| HERO SECTION
|--------------------------------------------------------------------------
*/

function updateHero(sectionEl, data = {}) {
    const light = sectionEl.querySelector(".hero-title-light");
    const main = sectionEl.querySelector(".hero-title-main");
    const accent = sectionEl.querySelector(".hero-title-accent");

    if (light && title.light !== undefined) {
        light.textContent = title.light;
    }

    if (main && title.main !== undefined) {
        main.textContent = title.main;
    }

    if (accent && title.accent !== undefined) {
        accent.textContent = title.accent;
    }
}

/*
|--------------------------------------------------------------------------
| FOOTER SECTION
|--------------------------------------------------------------------------
*/

function updateFooterSocials(sectionEl, socials) {
    const container = sectionEl.querySelector(".footer-socials");
    if (!container) return;

    container.innerHTML = "";

    socials
        .filter((item) => item?.link && item?.icon)
        .forEach(({ link, icon }) => {
            const a = document.createElement("a");
            a.href = link;
            a.target = "_blank";
            a.rel = "noopener noreferrer";

            const i = document.createElement("i");
            i.className = icon;

            a.appendChild(i);
            container.appendChild(a);
        });
}
