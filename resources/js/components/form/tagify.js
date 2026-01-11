import Tagify from "@yaireo/tagify";

export default class TagifyManager {
    static instances = {};

    constructor({ elementId, options = {} }) {
        if (!elementId) {
            throw new Error("TagifyManager: elementId is required");
        }

        const inputElem = document.getElementById(elementId);

        if (!inputElem) {
            throw new Error(`TagifyManager: element #${elementId} not found`);
        }

        this.tagify = new Tagify(inputElem, {
            whitelist: options,
            enforceWhitelist: true,
            userInput: false,
            dropdown: {
                maxItems: 10,
                classname: "tags-look customLook",
                enabled: 0,
                closeOnSelect: false,
            },
        });

        TagifyManager.instances[elementId] = this;
    }

    /* ------------------------------- */
    /* Actions */
    /* ------------------------------- */
    addTags(tags = []) {
        this.tagify.addTags(tags);
    }

    removeTags() {
        this.tagify.removeAllTags();
    }

    destroy() {
        this.tagify.destroy();
    }

    /* ------------------------------- */
    /* Events */
    /* ------------------------------- */
    on(event, callback) {
        this.tagify.on(event, callback);
    }
}
