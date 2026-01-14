import MessageToast from "@js/utils/message-toast";
import { closeModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { initDragFiles } from "@js/utils/drag-files";
import validateImageFiles from "@js/utils/validate-image-files";
import generateUuid from "@js/utils/generate-uuid";

document.addEventListener("alpine:init", () => {
    Alpine.data("companyProjectFormCreateComponent", () => ({
        /* 
        |-------------------------------
        | Properties
        |------------------------------- 
        */
        files: [],
        dragAreaElement: null,
        fileInputElement: null,

        /* 
        |-------------------------------
        | Init
        |------------------------------- 
        */
        init() {
            this.initState();
            this.registerListeners();
        },

        initState() {
            this.dragAreaElement = this.$el.querySelector("#drag-area");
            this.fileInputElement = this.$el.querySelector("#file-input");

            initDragFiles({
                dragArea: this.dragAreaElement,
                fileInput: this.fileInputElement,
                onDrop: (files) => this.validateFiles(files),
            });
        },

        /* 
        |-------------------------------
        | Actions
        |------------------------------- 
        */
        validateFiles(files) {
            const result = validateImageFiles(files, {
                maxSizeInMB: 5,
            });

            if (result.errors.invalidType || result.errors.oversize) {
                MessageToast("error");
                return;
            }

            const preparedFiles = this.prepareFiles(result.validFiles);

            this.files.push(...preparedFiles);

            this.uploadPreparedFiles(preparedFiles);

            this.dragAreaElement.classList.add("has-files");
        },

        prepareFiles(rawFiles) {
            return Array.from(rawFiles).map((file) => ({
                id: generateUuid(),
                file,
                name: file.name,
                size: file.size,
                progress: 0,
                status: "pending",
            }));
        },

        uploadPreparedFiles(files) {
            files.forEach((fileItem) => {
                fileItem.status = "uploading";

                this.$wire.upload(
                    "photos",
                    fileItem.file,
                    () => {
                        fileItem.progress = 100;
                        fileItem.status = "completed";
                    },
                    () => {
                        fileItem.status = "error";
                    },
                    (event) => {
                        fileItem.progress = event.detail.progress;
                    },
                );
            });
        },
        /* 
        |-------------------------------
        | Listeners
        |------------------------------- 
        */
        registerListeners() {
            this.listenToCompanyProjectCreatedEvent();
        },

        listenToCompanyProjectCreatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_CREATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.CREATE_COMPANY_PROJECT_MODAL,
                    });
                    MessageToast("created");
                },
            );
        },
    }));
});
