document.addEventListener("alpine:init", () => {
    Alpine.data("siteEditorComponent", () => ({
        /* 
        |-----------------------------
        | State
        |----------------------------- 
        */
        sections: {},
        order: [],

        /* 
        |-----------------------------
        | Init
        |----------------------------- 
        */
        init() {
            this.initState();
        },

        initState() {
            const allSections = this.$wire.get("landingSectionsData") || {};

            // Only keep safe editable keys
            this.sections = Object.fromEntries(
                Object.entries(allSections).map(([key, section]) => {
                    return [
                        key,
                        {
                            key: key,
                            title: section.title ?? "",
                            description: section.description ?? "",
                            visible: section.visible ?? true,
                            order: section.order ?? 0,
                            data: section.data ?? {},
                        },
                    ];
                }),
            );

            // Set section order based on keys
            this.order = Object.keys(this.sections);

            this.initIframe();
            this.initSortable();

            // Watch for changes and update preview
            this.$watch("sections", () => this.updatePreviewDebounced());
        },

        // Iframe Previe
        initIframe() {
            this.$refs.iframPreview.addEventListener("load", () => {
                this.updatePreviewDebounced();
                setTimeout(() => {
                    this.$refs.iframeContainer.classList.remove("spinner");
                }, 1000);
            });
        },

        //  Drag & Drop
        initSortable() {
            const el = this.$refs.sectionsContainer;

            Sortable.create(el, {
                animation: 150,
                handle: ".site-editor-inputs",
                onStart: (evt) => evt.item.classList.add("dragging"),
                onEnd: (evt) => {
                    const newOrder = Array.from(el.children)
                        .map((child) => child.dataset.key)
                        .filter(Boolean);

                    this.order = newOrder;

                    const reordered = {};
                    newOrder.forEach((key, index) => {
                        reordered[key] = this.sections[key];
                        reordered[key].order = index + 1;
                    });

                    this.sections = reordered;
                    evt.item.classList.remove("dragging");
                },
            });
        },

        /* 
        |-------------------------------
        |   Actions
        |------------------------------- 
        */
        addLink(sectionKey) {
            const socials = this.sections?.[sectionKey]?.data?.socials || [];

            this.sections[sectionKey].data.socials = [
                ...socials,
                { title: "", link: "" },
            ];

            this.sections = JSON.parse(JSON.stringify(this.sections));
        },

        // Delete link from footer
        deleteLink(sectionKey, index) {
            const socials = this.sections[sectionKey]?.data?.socials;

            if (!Array.isArray(socials)) {
                return;
            }

            socials.splice(index, 1);

            this.sections = JSON.parse(JSON.stringify(this.sections));
        },

        // Save and update landing sections
        submit() {
            if (!this.sections) {
                return;
            }

            this.$wire.call("submit", this.sections, this.order);
        },

        // Realtime landing preview
        updatePreview() {
            const data = JSON.parse(JSON.stringify(this.sections));
            this.$refs.iframPreview.contentWindow.postMessage(
                {
                    type: "site-editor-preview",
                    data: data,
                },
                "*",
            );
        },

        updatePreviewDebounced: Alpine.debounce(function () {
            this.updatePreview();
        }, 400),
    }));
});
