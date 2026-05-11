import { MODALS, UI_EVENTS } from "@js/utils/enums";
import { MODALS_EVENT } from "@js/utils/events";
import { closeModal, showModal } from "@js/components/modal/_modal";
import { DragFiles } from "@js/common/form/drag-files";
import generateUuid from "@js/utils/generate-uuid";
import MessageToast from "@js/utils/message-toast";
import validateFileInput from "@js/common/form/validate-file-input"; 

document.addEventListener("alpine:init", () => {
    Alpine.data("projectFormUpdateComponent", () => ({

        /*
        |--------------------------------------------------------------------------
        | State
        |--------------------------------------------------------------------------
        */

        images: [],
        existingImages: [],
        removedImageIds: [],

        file: null,
        existingFile: null,
        removedFileId: null,

        activeUploads: 0,
        maxConcurrentUploads: 5,
        isEditing: true,

        dragImagesAreaElement: null,
        imageInputElement: null,
        dragFileAreaElement: null,
        fileInputElement: null,

        /*
        |--------------------------------------------------------------------------
        | Init
        |--------------------------------------------------------------------------
        */

        init() {
            this.initDragAreas();
            this.registerListeners();
        },

        initDragAreas() {
            this.dragImagesAreaElement = this.$el.querySelector("#update-image-drag-area");
            this.imageInputElement     = this.$el.querySelector("#update-image-input");

            this.dragFileAreaElement   = this.$el.querySelector("#update-file-drag-area");
            this.fileInputElement      = this.$el.querySelector("#update-file-input");

            new DragFiles({
                dragArea: this.dragImagesAreaElement,
                fileInput: this.imageInputElement,
                onDrop: (images) => this.validateImages(images),
            });

            new DragFiles({
                dragArea: this.dragFileAreaElement,
                fileInput: this.fileInputElement,
                onDrop: (file) => this.validateFile(file),
            });
        },

        /*
        |--------------------------------------------------------------------------
        | Edit Flow
        |--------------------------------------------------------------------------
        */

        async editCompanyProject(projectUuid, triggerEl) {
            if (!projectUuid || !triggerEl) {
                MessageToast("error");
                return;
            }

            await this.$wire.call("editCompanyProject", projectUuid);

            this.existingImages = this.$wire.get("form.existingImages") ?? [];
            this.existingFile   = this.$wire.get("form.existingFile") ?? null;

            this.hydrateExistingImages();
            this.hydrateExistingFile();

            showModal({
                modalId: MODALS.UPDATE_COMPANY_PROJECT_MODAL,
                callback: () => triggerEl.classList.remove("spinner"),
            });
        },

        hydrateExistingImages() {
            this.images = this.existingImages.map((image) => ({
                id: generateUuid(),
                name: image.name ?? "image",
                preview: image.path,
                progress: 100,
                status: "completed",
                isExisting: true,
                serverId: image.id,
                upload: null,
            }));

            this.syncImagesAreaClass();
        },

        hydrateExistingFile() {
            if (!this.existingFile) {
                this.file = null;
                return;
            }

            this.file = {
                id: generateUuid(),
                name: this.existingFile.name ?? "file",
                preview: this.existingFile.path,
                progress: 100,
                status: "completed",
                isExisting: true,
                serverId: this.existingFile.id,
                upload: null,
            };

            this.syncFileAreaClass();
        },

        /*
        |--------------------------------------------------------------------------
        | Image Handling
        |--------------------------------------------------------------------------
        */

        resetFileBeforeUpload(event) {
            event.target.value = "";
        },

        validateImages(files) {
            const result = validateFileInput(files, {
                allowedExtensions: ["jpg", "jpeg", "png", "webp", "gif"],
                maxSizeInMB: 5,
            });

            if (!result.isValid) {
                MessageToast("error", result.errorMessage);
                return;
            }

            const newImages = Array.from(result.validFiles).map((file) => ({
                id: generateUuid(),
                file,
                name: file.name,
                size: file.size,
                preview: URL.createObjectURL(file),
                progress: 0,
                status: "pending",
                isExisting: false,
                serverId: null,
                upload: null,
            }));

            this.images.push(...newImages);
            this.syncImagesAreaClass();
            this.processQueue();
        },

        processQueue() {
            while (
                this.activeUploads < this.maxConcurrentUploads &&
                this.hasPendingImages()
            ) {
                const next = this.getNextPendingImage();
                if (!next) break;
                this.uploadImage(next);
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

                (e) => {
                    imageItem.progress = e.detail.progress;
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
            if (!image) return;

            if (image.isExisting && !this.removedImageIds.includes(image.serverId)) {
                this.removedImageIds.push(image.serverId);
                this.existingImages = this.existingImages.filter(
                    (i) => i.id !== image.serverId,
                );
            }

            if (image.upload) image.upload.cancel();

            if (!image.isExisting) {
                URL.revokeObjectURL(image.preview);
            }

            this.images = this.images.filter((i) => i.id !== imageId);
            this.syncImagesAreaClass();
            this.processQueue();
        },

        resetImages() {
            this.images.forEach((img) => {
                if (!img.isExisting) URL.revokeObjectURL(img.preview);
            });

            this.images = [];
            this.existingImages = [];
            this.removedImageIds = [];
            this.activeUploads = 0;

            this.$wire.set("form.images", []);
            this.dragImagesAreaElement?.classList.remove("has-files");
        },

        hasPendingImages() {
            return this.images.some((i) => i.status === "pending");
        },

        getNextPendingImage() {
            return this.images.find((i) => i.status === "pending");
        },

        syncImagesAreaClass() {
            this.images.length > 0
                ? this.dragImagesAreaElement?.classList.add("has-files")
                : this.dragImagesAreaElement?.classList.remove("has-files");
        },

        /*
        |--------------------------------------------------------------------------
        | File Handling
        |--------------------------------------------------------------------------
        */

        validateFile(file) {
            const result = validateFileInput(file, {
                allowedExtensions: ["pdf", "doc", "docx"],
                maxSizeInMB: 10,
            });

            if (!result.isValid) {
                MessageToast("error", result.errorMessage);
                return;
            }

            if (this.file) this.removeFile();

            this.file = {
                id: generateUuid(),
                file: result.validFiles[0],
                name: result.validFiles[0].name,
                size: result.validFiles[0].size,
                progress: 0,
                status: "pending",
                isExisting: false,
                serverId: null,
                upload: null,
            };

            this.uploadFile(this.file);
            this.syncFileAreaClass();
        },

        uploadFile(fileItem) {
            fileItem.status = "uploading";

            fileItem.upload = this.$wire.upload(
                "form.file",
                fileItem.file,

                () => {
                    fileItem.progress = 100;
                    fileItem.status = "completed";
                },

                () => {
                    fileItem.status = "error";
                },

                (e) => {
                    fileItem.progress = e.detail.progress;
                },

                () => {
                    fileItem.status = "cancelled";
                },
            );
        },

        removeFile() {
            if (!this.file) return;

            if (this.file.isExisting) {
                this.removedFileId = this.file.serverId;
                this.existingFile = null;
            }

            if (this.file.upload) this.file.upload.cancel();

            this.$wire.set("form.file", null);

            this.file = null;
            this.syncFileAreaClass();
        },

        resetFile() {
            this.$wire.set("form.file", null);
            this.file = null;
            this.removedFileId = null;
            this.existingFile = null;

            this.dragFileAreaElement?.classList.remove("has-files");
        },

        syncFileAreaClass() {
            this.file
                ? this.dragFileAreaElement?.classList.add("has-files")
                : this.dragFileAreaElement?.classList.remove("has-files");
        },

        /*
        |--------------------------------------------------------------------------
        | Submit
        |--------------------------------------------------------------------------
        */

        submit() {
            const hasImages =
                this.existingImages.length > 0 ||
                this.images.some((i) => i.status === "completed");

            const hasFile =
                this.existingFile ||
                (this.file && this.file.status === "completed");

            if (!hasImages) {
                MessageToast("warning", "Images are required.");
                return;
            }

            if (!hasFile) {
                MessageToast("warning", "Brochure is required.");
                return;
            }

            this.$wire.call(
                "handleSubmit",
                this.removedImageIds,
                this.removedFileId,
            );
        },

        /*
        |--------------------------------------------------------------------------
        | Listeners
        |--------------------------------------------------------------------------
        */

        registerListeners() {
            window.addEventListener( MODALS_EVENT.opened(MODALS.UPDATE_COMPANY_PROJECT_MODAL), ({ detail }) =>
                    this.editCompanyProject(
                        detail.companyProjectUuid,
                        detail.triggerEl,
                    ),
            );

            this.$el.addEventListener( UI_EVENTS.COMPANY_PROJECT_UPDATED_EVENT, () => {
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