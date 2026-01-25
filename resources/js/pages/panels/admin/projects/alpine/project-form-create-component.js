import MessageToast from "@js/utils/message-toast";
import { closeModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { DragFiles } from "@js/utils/drag-files";
import validateFileInput from "@js/utils/validate-file-input";
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
        | Image Handling
        |-------------------------------
        */
        validateImages(images) {
            const result = validateFileInput(images, {
                allowedExtensions: ["jpg", "jpeg", "png", "webp", "gif"],
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
        | Image Uploading Helpers
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
        | File Handling
        |-------------------------------
        */
        validateFile(file) {
            console.log(file);

            const result = validateFileInput(file, {
                allowedExtensions: ["pdf", "doc", "docx"],
                maxSizeInMB: 10,
            });

            if (result.errors.invalidType || result.errors.oversize) {
                MessageToast("error");
                return;
            }

            const validFile = result.validFiles[0]; // Extract File

            this.file = this.prepareFile(validFile);

            this.uploadFile(this.file);

            this.dragFileAreaElement.classList.add("has-files");
        },

        prepareFile(file) {
            return {
                id: generateUuid(),
                file,
                name: file.name,
                size: file.size,
                preview: file.url,
                progress: 0,
                status: "pending", // pending | uploading | completed | error | cancelled
                upload: null,
            };
        },

        uploadFile(fileItem) {
            console.log(fileItem);

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

        cancelFile(fileItem) {
            if (!fileItem) {
                return;
            }

            if (fileItem.status === "uploading" && fileItem.upload) {
                fileItem.upload.cancel();
            }

            fileItem.status = "cancelled";
            fileItem.progress = 0;

            URL.revokeObjectURL(fileItem.preview);

            this.file = null;

            if (!this.file) {
                this.dragFileAreaElement.classList.remove("has-files");
                return;
            }
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
            if (this.images.length === 0) {
                MessageToast("warning", "Images are required");
                return;
            }

            this.$wire.call("handleSubmit");
        },

        /* 
        |-------------------------------
        | Listeners
        |-------------------------------
        */
        registerListeners() {
            this.onCreatedProjectEvent();
        },

        onCreatedProjectEvent() {
            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_CREATED_EVENT,
                () => {
                    closeModal({
                        modalId: MODALS.CREATE_COMPANY_PROJECT_MODAL,
                    });

                    MessageToast("created");

                    this.resetImages();
                    this.resetFile();
                },
            );
        },
    }));
});
