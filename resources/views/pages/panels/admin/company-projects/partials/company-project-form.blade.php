@props(['prefix'])

{{-- Uploaded Images --}}
<div class="upload-section upload-section-images">

    <x-form.upload
        input-id="{{ $prefix }}-image-input"
        drag-id="{{ $prefix }}-image-drag-area"
        description="Drag & drop images here, or click to select images"
        accept="jpg,jpeg,png,webp,gif"
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
                <div
                    class="file-upload"
                    :class="image.status"
                >

                    {{-- Thumbnail --}}
                    <img
                        :src="image.preview"
                        class="file-preview"
                        alt=""
                    />

                    <div class="file-info">
                        <p
                            class="file-name"
                            x-text="image.name"
                        >
                        </p>

                        <div class="file-meta">
                            <span
                                class="file-size"
                                x-text="image.size"
                            >
                            </span>

                            <span
                                class="file-status"
                                :class="image.status"
                            >
                                <div class="file-status-dot"></div>

                                <span x-text="image.status"></span>
                            </span>
                        </div>

                        {{-- Progress --}}
                        <span
                            class="progress-text"
                            x-text="`${image.progress}%`"
                        >
                        </span>

                        <div class="progress-bar">
                            <div
                                class="progress"
                                :style="`width: ${image.progress}%`"
                            >
                            </div>
                        </div>
                    </div>

                    <div class="file-actions">

                        <x-button.outlined
                            class="sm icon danger"
                            x-show="!isEditing"
                            @click="cancelImage(image.id)"
                        >
                            <i class="fi fi-rr-cross-small"></i>
                        </x-button.outlined>

                        <x-button.outlined
                            class="sm icon"
                            x-show="isEditing"
                            @click="removeImage(image.id)"
                        >
                            <i class="fi fi-rr-trash"></i>
                        </x-button.outlined>

                    </div>

                </div>
            </template>

            {{-- Add more --}}
            <div
                class="add-files"
                x-show="images.length > 0"
                @click="imageInputElement.click()"
            >
                <div class="add-files-icon">
                    <i class="fi fi-rr-cloud-upload"></i>
                </div>

                <p>Add more images</p>
            </div>

        </div>
    </div>
</div>


{{-- Uploaded File --}}
<div class="upload-section upload-section-file">

    <x-form.upload
        input-id="{{ $prefix }}-file-input"
        drag-id="{{ $prefix }}-file-drag-area"
        description="Drag & drop brochure here, or click to select brochure"
        accept="pdf,doc,docx"
        :multiple="false"
        error="form.file"
        @click="resetFileBeforeUpload($event)"
    />

    <div class="uploaded-files">
        <div class="file-wrapper">

            <template x-if="file">

                <div
                    class="file-upload"
                    :class="file.status"
                >

                    {{-- Thumbnail --}}
                    <i class="fi fi-rr-document file-preview-icon"></i>

                    <div class="file-info">

                        <p
                            class="file-name"
                            x-text="file.name"
                        >
                        </p>

                        <div class="file-meta">

                            <span
                                class="file-size"
                                x-text="file.size"
                            >
                            </span>

                            <span
                                class="file-status"
                                :class="file.status"
                            >
                                <div class="file-status-dot"></div>

                                <span x-text="file.status"></span>
                            </span>

                        </div>

                        {{-- Progress --}}
                        <span
                            class="progress-text"
                            x-text="`${file.progress}%`"
                        >
                        </span>

                        <div class="progress-bar">
                            <div
                                class="progress"
                                :style="`width: ${file.progress}%`"
                            >
                            </div>
                        </div>

                    </div>

                    {{-- File Actions --}}
                    <div class="file-actions">

                        <x-button.outlined
                            class="sm icon danger"
                            x-show="!isEditing"
                            @click="cancelFile()"
                        >
                            <i class="fi fi-rr-cross-small"></i>
                        </x-button.outlined>

                        <x-button.outlined
                            class="sm icon"
                            x-show="isEditing"
                            @click="removeFile()"
                        >
                            <i class="fi fi-rr-trash"></i>
                        </x-button.outlined>

                    </div>

                </div>

            </template>

        </div>
    </div>
</div>


{{-- Inputs --}}
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

{{-- Row --}}
<div class="project-form-row">
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

{{-- Row --}}
<div class="project-form-row">
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

{{-- Checkbox --}}
<x-form.checkbox
    label="Visible"
    wire:model="form.visible"
    error="form.visible"
/>
