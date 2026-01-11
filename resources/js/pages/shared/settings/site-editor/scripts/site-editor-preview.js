window.addEventListener("message", (event) => {
    const { type, data } = event.data || {};

    if (type !== "site-editor-preview" || !data) {
        return;
    }

    // Loop through each section key (hero, about, footer, etc.)
    Object.entries(data).forEach(([key, section]) => {
        const sectionElement = document.querySelector(`.${key}-section`);
        if (!sectionElement) return;

        // --- Handle order
        if (section.order) {
            sectionElement.style.order = section.order;
        }

        // --- Handle visibility
        if (section.visible === false) {
            sectionElement.classList.add("!hidden");
            return;
        } else {
            sectionElement.classList.remove("!hidden");
        }

        // --- Handle title & description
        const title = sectionElement.querySelector(".section-title");
        const description = sectionElement.querySelector(".section-paragraph");

        if (title && section.title !== undefined) {
            title.textContent = section.title;
        }

        if (description && section.description !== undefined) {
            description.textContent = section.description;
        }

        // --- Handle footer socials
        if (key === "footer" && section.data?.socials) {
            const socialsContainer =
                sectionElement.querySelector(".footer-socials");

            if (socialsContainer) {
                // Clear existing icons
                socialsContainer.innerHTML = "";

                section.data.socials.forEach((social) => {
                    // Skip invalid socials
                    if (!social?.link || !social?.icon) return;

                    // Create new link element
                    const a = document.createElement("a");
                    a.href = social.link;
                    a.target = "_blank";
                    a.rel = "noopener noreferrer";

                    // Create icon element
                    const i = document.createElement("i");
                    i.className = social.icon;

                    // Append icon to link
                    a.appendChild(i);

                    // Add to container
                    socialsContainer.appendChild(a);
                });
            }
        }
    });
});
