<x-form.upload
    id="file-input"
    multiple="true"
/>

{{-- Uploaded files --}}
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
                    <x-button.outline
                        class="cancel-btn danger"
                        label="Cancel"
                        x-show="!isEditing"
                        @click="cancelFile(image.id)"
                    />

                    {{-- Remove --}}
                    <x-button.outline
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

<x-form.input
    type="text"
    label="Title"
    wire:model="form.title"
    error="form.title"
/>

<x-form.input
    label="Description"
    wire:model="form.description"
    error="form.description"
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
    />
</div>

<div class="project__form-row">
    <x-form.input
        label="Address"
        wire:model="form.address"
        error="form.address"
    />

    <x-form.input
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
