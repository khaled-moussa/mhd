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

        maxConcurrentUploads: 5,
        activeUploads: 0,

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

            this.processQueue();

            this.dragAreaElement.classList.add("has-files");
        },

        prepareFiles(rawFiles) {
            return Array.from(rawFiles).map((file) => ({
                id: generateUuid(),
                file,
                name: file.name,
                size: file.size,
                preview: URL.createObjectURL(file), // image preview
                progress: 0,
                status: "pending", // pending | uploading | completed | error | cancelled
                upload: null, // Livewire upload reference
            }));
        },

        processQueue() {
            while (
                this.activeUploads < this.maxConcurrentUploads &&
                this.hasPendingFiles()
            ) {
                const nextFile = this.getNextPendingFile();
                if (!nextFile) return;

                this.uploadFile(nextFile);
            }
        },

        uploadFile(fileItem) {
            this.activeUploads++;
            fileItem.status = "uploading";

            fileItem.upload = this.$wire.upload(
                "form.images",
                fileItem.file,

                // Success
                () => {
                    fileItem.progress = 100;
                    fileItem.status = "completed";
                    this.activeUploads--;
                    this.processQueue();
                },

                // Error
                () => {
                    fileItem.status = "error";
                    this.activeUploads--;
                    this.processQueue();
                },

                // Progress
                (event) => {
                    fileItem.progress = event.detail.progress;
                },

                // Cancelled
                () => {
                    fileItem.status = "cancelled";
                    this.activeUploads--;
                    this.processQueue();
                },
            );
        },

        cancelFile(fileId) {
            const file = this.files.find((f) => f.id === fileId);
            if (!file) return;

            // Cancel active upload
            if (file.status === "uploading" && file.upload) {
                file.upload.cancel();
            }

            file.status = "cancelled";
            file.progress = 0;

            // Free memory
            URL.revokeObjectURL(file.preview);

            // Remove from list (optional)
            this.files = this.files.filter((f) => f.id !== fileId);

            this.processQueue();
        },

        resetFiles() {
            // Revoke previews
            this.files.forEach((file) => URL.revokeObjectURL(file.preview));

            // Reset files array
            this.files = [];

            // Reset drag area state
            if (this.dragAreaElement) {
                this.dragAreaElement.classList.remove("has-files");
            }

            // Reset active uploads
            this.activeUploads = 0;
        },

        /* 
        |-------------------------------
        | Helpers
        |------------------------------- 
        */
        hasPendingFiles() {
            return this.files.some((file) => file.status === "pending");
        },

        getNextPendingFile() {
            return this.files.find((file) => file.status === "pending");
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

                    // Reset uploaded files
                    this.resetFiles();
                },
            );
        },
    }));
});
