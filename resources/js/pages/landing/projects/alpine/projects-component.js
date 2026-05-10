import MessageToast from "@js/utils/message-toast";

document.addEventListener("alpine:init", () => {
    Alpine.data("projectsComponent", () => ({
        /* 
        |-------------------------------
        | Properties
        |------------------------------- 
        */
        isProjectSection: false,

        /* 
        |-------------------------------
        | Init
        |------------------------------- 
        */
        init() {
            this.initState();
        },

        initState() {
            this.isProjectSection = this.$wire.get("isProjectSection");
        },

        /* 
        |-------------------------------
        | Actions
        |------------------------------- 
        */
        async viewProject(projectUuid) {
            if (!this.isValidUuid(projectUuid)) {
                return this.showError();
            }

            await this.$wire.call("viewProject", projectUuid);
        },

        /* 
        |-------------------------------
        | Helpers
        |------------------------------- 
        */
        isValidUuid(uuid) {
            return Boolean(uuid);
        },

        showError() {
            MessageToast("error");
        },
    }));
});
