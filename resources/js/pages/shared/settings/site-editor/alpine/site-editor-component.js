import MessageToast from "@js/utils/message-toast";
import { UI_EVENTS } from "@js/utils/enums";

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
            this.registerListeners();
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

                setTimeout(() => {
                    this.$refs.iframeContainer.classList.remove("spinner");
                }, 1000);
            });
        },

        initWatch() {
            this.$watch("sections", () => this.updatePreviewDebounced());
        },

        /*
        |--------------------------------------------------------------------------
        | Helpers
        |--------------------------------------------------------------------------
        */

        normalizeLink(value) {
            if (!value) return "";

            value = value.trim();

            // Email → mailto:
            if (value.includes("@") && !value.startsWith("mailto:")) {
                return `mailto:${value}`;
            }

            // Phone → tel:
            if (/^[0-9+\s()-]+$/.test(value) && !value.startsWith("tel:")) {
                return `tel:${value.replace(/\s/g, "")}`;
            }

            return value;
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

        /*
        |--------------------------------------------------------------------------
        | Preview
        |--------------------------------------------------------------------------
        */

        updatePreview() {
            const data = JSON.parse(JSON.stringify(this.sections));

            this.$refs.iframPreview.contentWindow.postMessage(
                {
                    type: "site-editor-preview",
                    data,
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

            const data = JSON.parse(JSON.stringify(this.sections));

            // normalize links before sending to backend
            Object.keys(data).forEach((sectionKey) => {
                const section = data[sectionKey];

                if (!section?.data?.socials) return;

                section.data.socials = section.data.socials.map((social) => ({
                    ...social,
                    link: this.normalizeLink(social.link),
                }));
            });

            this.$wire.call("submit", data, this.order);
        },

        /*
        |--------------------------------------------------------------------------
        | Events
        |--------------------------------------------------------------------------
        */

        registerListeners() {
            this.onSideUpdatedEvent();
        },

        onSideUpdatedEvent() {
            this.$el.addEventListener(UI_EVENTS.SITE_UPDATED_EVENT, () => {
                MessageToast("updated");
            });
        },
    }));
});
