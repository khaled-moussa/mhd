window.addEventListener("message", (event) => {
    const { type, data } = event.data || {};

    if (type !== "site-editor-preview" || !data) {
        return;
    }

    // Sort sections by order
    const sortedSections = Object.values(data)
        .filter((section) => section.order !== undefined)
        .sort((a, b) => a.order - b.order);

    console.log(sortedSections);

    sortedSections.forEach((section) => {
        const sectionElement = document.querySelector(`#${section.key}`);

        if (!sectionElement) {
            return;
        }

        const parent = sectionElement.parentElement;

        if (!parent) {
            return;
        }

        // Move node (THIS reorders the DOM)
        parent.appendChild(sectionElement);

        // Visibility
        if (section.visible === false) {
            sectionElement.classList.add("!hidden");
            return;
        } else {
            sectionElement.classList.remove("!hidden");
        }

        // Title & description
        const title = sectionElement.querySelector("#section-title");
        const description = sectionElement.querySelector(
            "#section-description",
        );

        if (title && section.title !== undefined) {
            title.textContent = section.title;
        }

        if (description && section.description !== undefined) {
            description.textContent = section.description;
        }

        if (section.key === "footer" && section.data?.socials) {
            const socialsContainer =
                sectionElement.querySelector(".footer-socials");

            if (!socialsContainer) {
                return;
            }

            // Clear existing icons
            socialsContainer.innerHTML = "";

            section.data.socials.forEach((social) => {
                // Skip invalid socials
                if (!social?.link || !social?.icon) {
                    return;
                }

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
    });
});
