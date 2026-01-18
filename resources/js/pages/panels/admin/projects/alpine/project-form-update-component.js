import MessageToast from "@js/utils/message-toast";
import { closeModal, showModal } from "@js/components/modal/_modal";
import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { initDragFiles } from "@js/utils/drag-files";
import validateImageFiles from "@js/utils/validate-image-files";
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

        dragAreaElementement: null,
        imageInputElement: null,

        maxConcurrentUploads: 5,
        activeUploads: 0,

        isEditing: true,

        /* 
        |-------------------------------
        | Init
        |------------------------------- 
        */
        init() {
            this.setupElements();
            this.registerListeners();
        },

        setupElements() {
            this.dragAreaElement = this.$el.querySelector("#drag-area");
            this.imageInputElement = this.$el.querySelector("#file-input");

            initDragFiles({
                dragArea: this.dragAreaElement,
                fileInput: this.imageInputElement,
                onDrop: (files) => this.validateImages(files),
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

            this.hydrateExistingImages();

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
                    uploadRequest: null,
                });
            });

            if (this.images.length) {
                this.dragAreaElement.classList.add("has-files");
            }
        },

        /* 
        |-------------------------------
        | Upload Flow
        |------------------------------- 
        */
        validateImages(files) {
            const result = validateImageFiles(files, { maxSizeInMB: 5 });

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
                    uploadRequest: null,
                }),
            );

            this.images.push(...newImages);

            if (this.images.length) {
                this.dragAreaElement.classList.add("has-files");
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

            imageItem.uploadRequest = this.$wire.upload(
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

        /* 
        |-------------------------------
        | Remove Image
        |------------------------------- 
        */
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
            if (image.uploadRequest) {
                image.uploadRequest.cancel();
            }

            // Cleanup preview
            if (!image.isExisting) {
                URL.revokeObjectURL(image.preview);
            }

            // Remove from UI
            this.images = this.images.filter((i) => i.id !== imageId);

            if (this.images.length === 0) {
                this.dragAreaElement.classList.remove("has-files");
            }

            this.processQueue();
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
        | Helpers
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
                    this.resetImages();

                    closeModal({
                        modalId: MODALS.UPDATE_COMPANY_PROJECT_MODAL,
                    });

                    MessageToast("updated");
                },
            );
        },
    }));
});
