import MessageToast          from '@js/utils/message-toast';
import generateUuid          from '@js/utils/generate-uuid';
import validateFileInput     from '@js/utils/validate-file-input';
import { closeModal }        from '@js/components/modal/_modal';
import { MODALS, FORMS, UI_EVENTS } from '@js/utils/enums';
import { DragFiles }         from '@js/utils/drag-files';
import { MODALS_EVENT }      from '@js/utils/events';
import resetFormValidation   from '@js/utils/reset-form-validation';

document.addEventListener('alpine:init', () => {
    Alpine.data('projectFormCreateComponent', () => ({

        /*
        |--------------------------------------------------------------------------
        | State
        |--------------------------------------------------------------------------
        */

        images:   [],
        file:     null,
        isEditing: false,

        maxConcurrentUploads: 5,
        activeUploads:        0,

        dragImagesAreaElement: null,
        imageInputElement:     null,
        dragFileAreaElement:   null,
        fileInputElement:      null,

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
            this.dragImagesAreaElement = this.$el.querySelector('#image-drag-area');
            this.imageInputElement     = this.$el.querySelector('#image-input');
            this.dragFileAreaElement   = this.$el.querySelector('#file-drag-area');
            this.fileInputElement      = this.$el.querySelector('#file-input');

            new DragFiles({
                dragArea:  this.dragImagesAreaElement,
                fileInput: this.imageInputElement,
                onDrop:    (images) => this.validateImages(images),
            });

            new DragFiles({
                dragArea:  this.dragFileAreaElement,
                fileInput: this.fileInputElement,
                onDrop:    (file) => this.validateFile(file),
            });
        },

        /*
        |--------------------------------------------------------------------------
        | Image Handling
        |--------------------------------------------------------------------------
        */

        resetFileBeforeUpload(event) {
            event.target.value = '';
        },

        validateImages(images) {
            console.log(images, 'CREATE');
            
            const result = validateFileInput(images, {
                allowedExtensions: ['jpg', 'jpeg', 'png', 'webp', 'gif'],
                maxSizeInMB: 5,
            });

            if (! result.isValid) {
                MessageToast('error', result.errorMessage);
                return;
            }

            this.images.push(...this.prepareImages(result.validFiles));
            this.dragImagesAreaElement.classList.add('has-files');
            this.processQueue();
        },

        prepareImages(rawImages) {
            return Array.from(rawImages).map(image => ({
                id:       generateUuid(),
                image,
                name:     image.name,
                size:     image.size,
                preview:  URL.createObjectURL(image),
                progress: 0,
                status:   'pending',
                upload:   null,
                livewireIndex: null,
            }));
        },

        processQueue() {
            while (this.activeUploads < this.maxConcurrentUploads && this.hasPendingImages()) {
                const next = this.getNextPendingImage();
                if (! next) break;
                this.uploadImage(next);
            }
        },

        uploadImage(imageItem) {
            this.activeUploads++;
            imageItem.status = 'uploading';

            imageItem.upload = this.$wire.upload(
                'form.images',
                imageItem.image,

                // Success
                () => {
                    imageItem.progress = 100;
                    imageItem.status   = 'completed';
                    this.activeUploads--;
                    this.processQueue();
                },

                // Error
                () => {
                    imageItem.status = 'error';
                    this.activeUploads--;
                    this.processQueue();
                },

                // Progress
                (event) => {
                    imageItem.progress = event.detail.progress;
                },

                // Cancelled
                () => {
                    imageItem.status = 'cancelled';
                    this.activeUploads--;
                    this.processQueue();
                },
            );
        },

        cancelImage(imageId) {
            const imageItem = this.images.find(img => img.id === imageId);
            if (! imageItem) return;

            // Cancel active upload
            if (imageItem.status === 'uploading' && imageItem.upload) {
                imageItem.upload.cancel();
                this.activeUploads--;
            }

            // Remove from Livewire's form.images to avoid submitting cancelled files
            if (imageItem.status === 'completed' || imageItem.status === 'uploading') {
                const currentImages = this.$wire.get('form.images') || [];
                const updatedImages = currentImages.filter((_, index) => index !== this.images
                        .filter(img => img.status === 'completed' || img.status === 'uploading')
                        .findIndex(img => img.id === imageId));

                this.$wire.set('form.images', updatedImages);
            }

            URL.revokeObjectURL(imageItem.preview);
            this.images = this.images.filter(img => img.id !== imageId);

            if (this.images.length === 0) {
                this.dragImagesAreaElement.classList.remove('has-files');
            }

            this.processQueue();
        },

        resetImages() {
            this.images.forEach(img => URL.revokeObjectURL(img.preview));
            this.images       = [];
            this.activeUploads = 0;
            this.$wire.set('form.images', []);
            this.dragImagesAreaElement?.classList.remove('has-files');
        },

        hasPendingImages() {
            return this.images.some(img => img.status === 'pending');
        },

        getNextPendingImage() {
            return this.images.find(img => img.status === 'pending');
        },

        /*
        |--------------------------------------------------------------------------
        | File Handling
        |--------------------------------------------------------------------------
        */

        validateFile(file) {
            const result = validateFileInput(file, {
                allowedExtensions: ['pdf', 'doc', 'docx'],
                maxSizeInMB: 10,
            });

            if (! result.isValid) {
                MessageToast('error', result.errorMessage);
                return;
            }

            this.file = this.prepareFile(result.validFiles[0]);
            this.uploadFile(this.file);
            this.dragFileAreaElement.classList.add('has-files');
        },

        prepareFile(file) {
            return {
                id:       generateUuid(),
                file,
                name:     file.name,
                size:     file.size,
                progress: 0,
                status:   'pending',
                upload:   null,
            };
        },

        uploadFile(fileItem) {
            fileItem.status = 'uploading';

            fileItem.upload = this.$wire.upload(
                'form.file',
                fileItem.file,

                // Success
                () => {
                    fileItem.progress = 100;
                    fileItem.status   = 'completed';
                },

                // Error
                () => {
                    fileItem.status = 'error';
                },

                // Progress
                (event) => {
                    fileItem.progress = event.detail.progress;
                },

                // Cancelled
                () => {
                    fileItem.status = 'cancelled';
                },
            );
        },

        cancelFile() {
            if (! this.file) return;

            if (this.file.status === 'uploading' && this.file.upload) {
                this.file.upload.cancel();
            }

            // Remove from Livewire
            this.$wire.set('form.file', null);

            this.file = null;
            this.dragFileAreaElement?.classList.remove('has-files');
        },

        resetFile() {
            if (! this.file) return;

            this.$wire.set('form.file', null);
            this.file = null;
            this.dragFileAreaElement?.classList.remove('has-files');
        },

        /*
        |--------------------------------------------------------------------------
        | Submit
        |--------------------------------------------------------------------------
        */

        submit() {
            const completedImages = this.images.filter(img => img.status === 'completed');

            if (completedImages.length === 0) {
                MessageToast('warning', 'Images are required.');
                return;
            }

            if (! this.file || this.file.status !== 'completed') {
                MessageToast('warning', 'Brochure is required.');
                return;
            }

            this.$wire.call('handleSubmit');
        },

        /*
        |--------------------------------------------------------------------------
        | Listeners
        |--------------------------------------------------------------------------
        */

        registerListeners() {
            window.addEventListener(
                MODALS_EVENT.closed(MODALS.CREATE_COMPANY_PROJECT_MODAL),
                () => {
                    this.resetImages();
                    this.resetFile();
                    resetFormValidation(FORMS.CREATE_COMPANY_PROJECT_FORM);
                }
            );

            this.$el.addEventListener(
                UI_EVENTS.COMPANY_PROJECT_CREATED_EVENT,
                () => {
                    closeModal({ modalId: MODALS.CREATE_COMPANY_PROJECT_MODAL });
                    MessageToast('created');
                    this.resetImages();
                    this.resetFile();
                }
            );
        },
    }));
});