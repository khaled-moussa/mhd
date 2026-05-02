{{-- Uploaded images --}}
<div class="upload-section upload-section--images">
    <x-form.upload
        input-id="image-input"
        drag-id="image-drag-area"
        description="'Drag & drop images here, or click to select images"
        accept="jpg, jpeg, png, webp, jpeg, gif"
        :multiple="true"
        error="form.images*"
        @click="resetFileBeforeUpload($event)"
    />

    <div class="uploaded-files">
        <div class="file-wrapper">
            <template
                x-for="image in images"
                :key="image.id"
            >
                <div class="file-upload">
                    {{-- Image Preview --}}
                    <img
                        :src="image.preview"
                        class="file-preview"
                        alt=""
                    />

                    <div class="file-info">
                        <p
                            class="file-name"
                            x-text="image.name"
                        ></p>

                        {{-- Progress --}}
                        <span
                            class="progress-text"
                            x-text="image.progress"
                        ></span>

                        <div class="progress-bar">
                            <div
                                class="progress"
                                :style="`width: ${image.progress}%`"
                            ></div>
                        </div>

                        {{-- Status --}}
                        <p
                            class="badge"
                            x-text="image.status"
                        ></p>

                        {{-- Cancel --}}
                        <x-button.outlined
                            class="cancel-btn danger"
                            label="Cancel"
                            x-show="!isEditing"
                            @click="cancelImage(image.id)"
                        />

                        {{-- Remove --}}
                        <x-button.outlined
                            class="cancel-btn danger"
                            label="Remove"
                            x-show="isEditing"
                            @click="removeImage(image.id)"
                        />
                    </div>
                </div>
            </template>

            {{-- Add more files --}}
            <div
                class="add-files"
                x-show="images.length > 0"
                @click="imageInputElement.click()"
            >
                <i class="fi fi-rr-cloud-upload"></i>
                <p class="description">Add more images</p>
            </div>
        </div>
    </div>
</div>

{{-- Uploaded file --}}
<div class="upload-section upload-section--file">
    <x-form.upload
        input-id="file-input"
        drag-id="file-drag-area"
        description="'Drag & drop brochure here, or click to select brochure"
        accept="pdf, doc, docx"
        :multiple="false"
        error="form.file"
        @click="resetFileBeforeUpload($event)"
    />

    <div class="uploaded-files">
        <div class="file-wrapper">
            <template x-if="file">
                <div class="file-upload">
                    {{-- Image Preview --}}
                    <a
                        :href="file.preview"
                        class="file-preview"
                    >
                    </a>

                    <div class="file-info">
                        <p
                            class="file-name"
                            x-text="file.name"
                        ></p>

                        {{-- Progress --}}
                        <span
                            class="progress-text"
                            x-text="file.progress"
                        ></span>

                        <div class="progress-bar">
                            <div
                                class="progress"
                                :style="`width: ${file.progress}%`"
                            ></div>
                        </div>

                        {{-- Status --}}
                        <p
                            class="badge"
                            x-text="file.status"
                        ></p>

                        {{-- Cancel --}}
                        <x-button.outlined
                            class="cancel-btn danger"
                            label="Cancel"
                            x-show="!isEditing"
                            @click="cancelFile(file)"
                        />

                        {{-- Remove --}}
                        <x-button.outlined
                            class="cancel-btn danger"
                            label="Remove"
                            x-show="isEditing"
                            @click="removeFile(file)"
                        />
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<x-form.input
    type="text"
    label="Title"
    wire:model="form.title"
    error="form.title"
    required
    minlength="3"
/>

<x-form.input
    label="Description"
    wire:model="form.description"
    error="form.description"
    required
    minlength="10"
/>

<div class="project__form-row">
    <x-form.input
        type="date"
        label="Delivered At"
        wire:model="form.deliveredAt"
        error="form.deliveredAt"
    />

    <x-form.input
        label="Price Start"
        wire:model="form.priceStart"
        error="form.priceStart"
        required
    />
</div>

<div class="project__form-row">
    <x-form.input
        label="Address"
        wire:model="form.address"
        error="form.address"
        required
    />

    <x-form.input
        type="url"
        label="Location"
        wire:model="form.location"
        error="form.location"
    />
</div>

<x-form.toggle
    label="Visible"
    wire:model="form.visible"
    error="form.visible"
/>
