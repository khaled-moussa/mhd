<form
    x-data="projectFormUpdateComponent"
    id="{{ $formId['UPDATE_COMPANY_PROJECT_FORM'] }}"
    @submit.prevent="submit"
>

    @include('admin::company-projects.partials.company-project-form')

    <div class="modal-actions">
        <x-button.outlined
            class="modal-close"
            label="Cancel"
            :data-custom-close="$modalId['UPDATE_COMPANY_PROJECT_MODAL']"
        />

        <x-button.primary
            label="Submit"
            wire:target="handleSubmit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
