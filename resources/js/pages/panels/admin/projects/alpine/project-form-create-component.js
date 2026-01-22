import MessageToast from "@js/utils/message-toast";
import { closeModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { initDragFiles } from "@js/utils/drag-files";
import validateImageFiles from "@js/utils/validate-image-files";
import generateUuid from "@js/utils/generate-uuid";

document.addEventListener("alpine:init", () => {
    Alpine.data("projectFormCreateComponent", () => ({
        /* 
        |-------------------------------
        | State
        |-------------------------------
        */
        images: [],
        dragImagesAreaElement: null,
        imageInputElement: null,

        file: null,
        dragFileAreaElement: null,
        fileInputElement: null,

        maxConcurrentUploads: 5,
        activeUploads: 0,

        isEditing: false,

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
            this.dragImagesAreaElement = this.$el.querySelector("#drag-area");
            this.imageInputElement = this.$el.querySelector("#file-input");

            initDragFiles({
                dragArea: this.dragImagesAreaElement,
                fileInput: this.imageInputElement,
                onDrop: (images) => this.validateImages(images),
            });
        },

        /* 
        |-------------------------------
        | Image Handling
        |-------------------------------
        */
        validateImages(images) {
            const result = validateImageFiles(images, {
                maxSizeInMB: 5,
            });

            if (result.errors.invalidType || result.errors.oversize) {
                MessageToast("error");
                return;
            }

            const preparedImages = this.prepareImages(result.validFiles);
            this.images.push(...preparedImages);

            this.processQueue();
            this.dragImagesAreaElement.classList.add("has-files");
        },

        prepareImages(rawImages) {
            return Array.from(rawImages).map((image) => ({
                id: generateUuid(),
                image,
                name: image.name,
                size: image.size,
                preview: URL.createObjectURL(image),
                progress: 0,
                status: "pending", // pending | uploading | completed | error | cancelled
                upload: null,
            }));
        },

        processQueue() {
            while (
                this.activeUploads < this.maxConcurrentUploads &&
                this.hasPendingImages()
            ) {
                const nextImage = this.getNextPendingImage();
                if (!nextImage) return;

                this.uploadImage(nextImage);
            }
        },

        uploadImage(imageItem) {
            this.activeUploads++;
            imageItem.status = "uploading";

            imageItem.upload = this.$wire.upload(
                "form.images",
                imageItem.image,

                // Success
                () => {
                    imageItem.progress = 100;
                    imageItem.status = "completed";
                    this.activeUploads--;
                    this.processQueue();
                },

                // Error
                () => {
                    imageItem.status = "error";
                    this.activeUploads--;
                    this.processQueue();
                },

                // Progress
                (event) => {
                    imageItem.progress = event.detail.progress;
                },

                // Cancelled
                () => {
                    imageItem.status = "cancelled";
                    this.activeUploads--;
                    this.processQueue();
                },
            );
        },

        cancelImage(imageId) {
            const imageItem = this.images.find((img) => img.id === imageId);

            if (!imageItem) {
                return;
            }

            if (imageItem.status === "uploading" && imageItem.upload) {
                imageItem.upload.cancel();
            }

            imageItem.status = "cancelled";
            imageItem.progress = 0;

            URL.revokeObjectURL(imageItem.preview);

            this.images = this.images.filter((img) => img.id !== imageId);

            if (this.images.length === 0) {
                this.dragImagesAreaElement.classList.remove("has-files");
                return;
            }

            this.processQueue();
        },

        resetImages() {
            this.images.forEach((img) => URL.revokeObjectURL(img.preview));

            this.images = [];
            this.activeUploads = 0;

            if (this.dragImagesAreaElement) {
                this.dragImagesAreaElement.classList.remove("has-files");
            }
        },

        /* 
        |-------------------------------
        | File Handling
        |-------------------------------
        */
        validateFile(file) {
            const result = validateImageFiles(file, {
                maxSizeInMB: 10,
            });

            if (result.errors.invalidType || result.errors.oversize) {
                MessageToast("error");
                return;
            }

            this.file = this.prepareFile(result.validFiles);

            this.dragFileAreaElement.classList.add("has-files");

            this.uploadFile();
        },

        prepareImages(file) {
            return {
                id: generateUuid(),
                file,
                name: file.name,
                size: file.size,
                preview: URL.createObjectURL(file),
                progress: 0,
                status: "pending", // pending | uploading | completed | error | cancelled
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

        cancelFile() {
            if (!this.file) {
                return;
            }

            if (fileItem.status === "uploading" && fileItem.upload) {
                imageItem.upload.cancel();
            }

            imageItem.status = "cancelled";
            imageItem.progress = 0;

            URL.revokeObjectURL(imageItem.preview);

            this.images = this.images.filter((img) => img.id !== imageId);

            if (this.images.length === 0) {
                this.dragImagesAreaElement.classList.remove("has-files");
                return;
            }

            this.processQueue();
        },

        resetImages() {
            this.images.forEach((img) => URL.revokeObjectURL(img.preview));

            this.images = [];
            this.activeUploads = 0;

            if (this.dragImagesAreaElement) {
                this.dragImagesAreaElement.classList.remove("has-files");
            }
        },

        /* 
        |-------------------------------
        | Submit
        |------------------------------- 
        */
        submit() {
            if (this.images.length === 0) {
                MessageToast("warning", "Images are required");
                return;
            }
            this.$wire.call("handleSubmit");
        },

        /* 
        |-------------------------------
        | Helpers
        |-------------------------------
        */
        hasPendingImages() {
            return this.images.some((img) => img.status === "pending");
        },

        getNextPendingImage() {
            return this.images.find((img) => img.status === "pending");
        },

        /* 
        |-------------------------------
        | Listeners
        |-------------------------------
        */
        registerListeners() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_CREATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.CREATE_COMPANY_PROJECT_MODAL,
                    });

                    MessageToast("created");
                    this.resetImages();
                },
            );
        },
    }));
});
