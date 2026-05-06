document.addEventListener("alpine:init", () => {
    Alpine.data("siteEditorComponent", () => ({
        /*
        |--------------------------------------------------------------------------
        | State
        |--------------------------------------------------------------------------
        */

        sections: {},
        order: [],

        /*
        |--------------------------------------------------------------------------
        | Init
        |--------------------------------------------------------------------------
        */

        init() {
            this.initState();
        },

        initState() {
            const raw = this.$wire.get("sections") || {};

            this.sections = Object.fromEntries(
                Object.entries(raw).map(([key, section]) => [
                    key,
                    {
                        key: section.key,
                        title: section.title ?? "",
                        description: section.description ?? "",
                        visible: section.visible ?? true,
                        order: section.order ?? 0,
                        data: section.data ?? {},
                    },
                ]),
            );

            this.order = Object.keys(this.sections);

            this.initIframe();
            this.initWatch();
        },

        initIframe() {
            this.$refs.iframPreview.addEventListener("load", () => {
                this.updatePreviewDebounced();
                setTimeout(
                    () =>
                        this.$refs.iframeContainer.classList.remove("spinner"),
                    1000,
                );
            });
        },

        initWatch() {
            this.$watch("sections", () => this.updatePreviewDebounced());
        },

        /*
        |--------------------------------------------------------------------------
        | Actions
        |--------------------------------------------------------------------------
        */

        addLink(sectionKey) {
            const socials = this.sections[sectionKey]?.data?.socials ?? [];

            this.sections[sectionKey].data.socials = [
                ...socials,
                { icon: "", link: "" },
            ];
            this.sections = { ...this.sections };
        },

        deleteLink(sectionKey, index) {
            const socials = this.sections[sectionKey]?.data?.socials;

            if (!Array.isArray(socials)) return;

            socials.splice(index, 1);
            this.sections = { ...this.sections };
        },

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

        /*
        |--------------------------------------------------------------------------
        | Submit
        |--------------------------------------------------------------------------
        */

        submit() {
            if (!this.sections) return;

            this.$wire.call("submit", this.sections, this.order);
        },
    }));
});
