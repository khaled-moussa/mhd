import MessageToast from "@js/utils/message-toast";
import { closeModal, showModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { DragFiles } from "@js/utils/drag-files";
import validateFileInput from "@js/utils/validate-file-input";
import generateUuid from "@js/utils/generate-uuid";

document.addEventListener("alpine:init", () => {
    Alpine.data("projectFormUpdateComponent", () => ({
        /* 
        |-------------------------------
        | State
        |------------------------------- 
        */
        images: [],
        existingImages: [],
        removedImageIds: [],

        dragImagesAreaElement: null,
        imageInputElement: null,

        file: null,
        existingfile: [],

        dragFileAreaElement: null,
        fileInputElement: null,

        maxConcurrentUploads: 5,
        activeUploads: 0,

        isEditing: true,

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
            this.dragImagesAreaElement =
                this.$el.querySelector("#image-drag-area");
            this.imageInputElement = this.$el.querySelector("#image-input");

            const imagesDrag = new DragFiles({
                dragArea: this.dragImagesAreaElement,
                fileInput: this.imageInputElement,
                onDrop: (images) => this.validateImages(images),
            });

            this.dragFileAreaElement =
                this.$el.querySelector("#file-drag-area");
            this.fileInputElement = this.$el.querySelector("#file-input");

            const fileDrag = new DragFiles({
                dragArea: this.dragFileAreaElement,
                fileInput: this.fileInputElement,
                onDrop: (file) => this.validateFile(file),
            });
        },

        /* 
        |-------------------------------
        | Edit Flow
        |------------------------------- 
        */
        async editCompanyProject(projectUuid, triggerEl) {
            if (!projectUuid || !triggerEl) {
                MessageToast("error");
                return;
            }

            await this.$wire.call("editCompanyProject", projectUuid);

            this.existingImages = this.$wire.get("form.existingImages");
            this.existingfile = this.$wire.get("form.existingFile");

            this.hydrateExistingImages();
            this.hydrateExistingFile();

            showModal({
                modalId: MODALS.UPDATE_COMPANY_PROJECT_MODAL,
                callback: () => triggerEl.classList.remove("spinner"),
            });
        },

        hydrateExistingImages() {
            this.images = [];

            this.existingImages.forEach((image) => {
                this.images.push({
                    id: generateUuid(),
                    name: image.name ?? "image",
                    preview: image.path,
                    progress: 100,
                    status: "completed",
                    isExisting: true,
                    serverId: image.id,
                    upload: null,
                });
            });

            if (this.images.length) {
                this.dragImagesAreaElement.classList.add("has-files");
            }
        },

        hydrateExistingFile() {
            this.file = null;

            this.file = {
                id: generateUuid(),
                name: this.existingfile.name ?? "file",
                preview: this.existingfile.path,
                progress: 100,
                status: "completed",
                isExisting: true,
                serverId: this.existingfile.id,
                upload: null,
            };

            if (this.file) {
                this.dragFileAreaElement.classList.add("has-files");
            }
        },

        /* 
        |-------------------------------
        | Upload Images Flow
        |------------------------------- 
        */
        validateImages(files) {
            const result = validateFileInput(files, {
                allowedExtensions: ["jpg", "jpeg", "png", "webp", "gif"],
                maxSizeInMB: 5,
            });

            if (result.errors.invalidType || result.errors.oversize) {
                MessageToast("error");
                return;
            }

            const newImages = Array.from(result.validFiles).map(
                (imageFile) => ({
                    id: generateUuid(),
                    file: imageFile,
                    name: imageFile.name,
                    preview: URL.createObjectURL(imageFile),
                    progress: 0,
                    status: "pending",
                    isExisting: false,
                    serverId: null,
                    upload: null,
                }),
            );

            this.images.push(...newImages);

            if (this.images.length) {
                this.dragImagesAreaElement.classList.add("has-files");
            }

            this.processQueue();
        },

        processQueue() {
            while (
                this.activeUploads < this.maxConcurrentUploads &&
                this.hasPendingImages()
            ) {
                const nextImage = this.nextPendingImage();
                if (!nextImage) {
                    return;
                }

                this.uploadImage(nextImage);
            }
        },

        uploadImage(imageItem) {
            this.activeUploads++;
            imageItem.status = "uploading";

            imageItem.upload = this.$wire.upload(
                "form.images",
                imageItem.file,

                () => {
                    imageItem.progress = 100;
                    imageItem.status = "completed";
                    this.activeUploads--;
                    this.processQueue();
                },

                () => {
                    imageItem.status = "error";
                    this.activeUploads--;
                    this.processQueue();
                },

                (event) => {
                    imageItem.progress = event.detail.progress;
                },

                () => {
                    imageItem.status = "cancelled";
                    this.activeUploads--;
                    this.processQueue();
                },
            );
        },

        removeImage(imageId) {
            const image = this.images.find((i) => i.id === imageId);

            if (!image) {
                return;
            }

            // Existing image → mark for deletion
            if (image.isExisting) {
                if (!this.removedImageIds.includes(image.serverId)) {
                    this.removedImageIds.push(image.serverId);
                    this.existingImages = this.existingImages.filter(
                        (i) => i.id !== image.serverId,
                    );
                }
            }

            // Cancel upload if active
            if (image.upload) {
                image.upload.cancel();
            }

            // Cleanup preview
            if (!image.isExisting) {
                URL.revokeObjectURL(image.preview);
            }

            // Remove from UI
            this.images = this.images.filter((i) => i.id !== imageId);

            if (this.images.length === 0) {
                this.dragImagesAreaElement.classList.remove("has-files");
            }

            this.processQueue();
        },

        /* 
        |-------------------------------
        | Image Uploading Helpers
        |-------------------------------
        */
        hasPendingImages() {
            return this.images.some((i) => i.status === "pending");
        },

        nextPendingImage() {
            return this.images.find((i) => i.status === "pending");
        },

        resetImages() {
            this.images.forEach((img) => {
                if (!img.isExisting) {
                    URL.revokeObjectURL(img.preview);
                }
            });

            this.images = [];
            this.removedImageIds = [];
            this.activeUploads = 0;

            this.dragAreaElement?.classList.remove("has-files");
        },

        /* 
        |-------------------------------
        | File Handling
        |-------------------------------
        */
        validateFile(file) {
            const result = validateFileInput(file, {
                allowedExtensions: ["pdf", "doc", "docx"],
                maxSizeInMB: 10,
            });

            if (result.errors.invalidType || result.errors.oversize) {
                MessageToast("error");
                return;
            }

            // Remove existing file first
            if (this.file) {
                this.removeFile(this.file);
            }

            const validFile = result.validFiles[0];

            this.file = this.prepareFile(validFile);

            this.dragFileAreaElement.classList.add("has-files");

            this.uploadFile(this.file);
        },

        prepareFile(file) {
            return {
                id: generateUuid(),
                file: file,
                name: file.name,
                preview: null,
                progress: 0,
                status: "pending",
                isExisting: false,
                serverId: null,
                upload: null,
            };
        },

        uploadFile(fileItem) {
            fileItem.status = "uploading";

            fileItem.upload = this.$wire.upload(
                "form.file",
                fileItem.file,

                // Success
                () => {
                    fileItem.progress = 100;
                    fileItem.status = "completed";
                },

                // Error
                () => {
                    fileItem.status = "error";
                },

                // Progress
                (event) => {
                    fileItem.progress = event.detail.progress;
                },

                // Cancelled
                () => {
                    fileItem.status = "cancelled";
                },
            );
        },

        removeFile(fileItem) {
            if (!fileItem) return;

            // Existing file → mark for deletion
            if (fileItem.isExisting) {
                this.removedFileId = fileItem.serverId;
            }

            // Cancel upload if active
            if (fileItem.upload) {
                fileItem.upload.cancel();
            }

            this.file = null;

            this.dragFileAreaElement.classList.remove("has-files");
        },

        resetFile() {
            URL.revokeObjectURL(this.file.preview);
            this.file = null;

            if (this.dragFileAreaElement) {
                this.dragFileAreaElement.classList.remove("has-files");
            }
        },

        /* 
        |-------------------------------
        | Submit
        |------------------------------- 
        */
        submit() {
            if (this.existingImages.length === 0 && this.images.length === 0) {
                MessageToast("warning", "Images are required");
                return;
            }

            this.$wire.call("handleSubmit", this.removedImageIds);
        },

        /* 
        |-------------------------------
        | Events
        |------------------------------- 
        */
        registerListeners() {
            this.onModalOpenEvent();
            this.onProjectUpdatedEvent();
        },

        onModalOpenEvent() {
            window.addEventListener(
                MODALS_EVENT.opened(MODALS.UPDATE_COMPANY_PROJECT_MODAL),
                ({ detail }) => {
                    this.editCompanyProject(
                        detail.companyProjectUuid,
                        detail.triggerEl,
                    );
                },
            );
        },

        onProjectUpdatedEvent() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_UPDATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.UPDATE_COMPANY_PROJECT_MODAL,
                    });

                    MessageToast("updated");

                    this.resetImages();
                    this.resetFile();
                },
            );
        },
    }));
});
