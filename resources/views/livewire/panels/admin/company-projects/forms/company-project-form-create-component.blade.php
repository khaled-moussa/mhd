<form
    x-data="companyProjectFormCreateComponent"
    id="{{ $formId['CREATE_COMPANY_PROJECT_FORM'] }}"
    class="service-form"
    wire:submit.prevent="submit"
>

    <x-form.upload
        id="file-input"
        multiple="true"
    />

    {{-- Uploaded files --}}
    <div class="uploaded-files">
        <div class="file-wrapper">
            <template
                x-for="file in files"
                :key="file.id"
            >
                <div class="file-upload">
                    <!-- Image Preview -->
                    <img
                        :src="file.preview"
                        class="file-preview"
                        alt=""
                    />

                    <div class="file-info">
                        <p
                            class="file-name"
                            x-text="file.name"
                        ></p>

                        <!-- Progress -->
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

                        <!-- Status -->
                        <p
                            class="badge"
                            x-text="file.status"
                        ></p>

                        <!-- Cancel -->
                        <x-button.outline
                            class="cancel-btn danger"
                            label="Cancel"
                            @click="cancelFile(file.id)"
                        />
                    </div>
                </div>
            </template>
        </div>
    </div>

    @include('admin::company-projects.partials.company-project-form')

    <div class="modal-actions">
        <x-button.outline
            class="modal-close"
            label="Cancel"
            :data-custom-close="$modal['CREATE_COMPANY_PROJECT_MODAL']"
        />

        <x-button.main
            label="Submit"
            wire:target="submit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
