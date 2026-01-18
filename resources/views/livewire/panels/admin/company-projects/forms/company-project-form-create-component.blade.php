<form
    x-data="projectFormCreateComponent"
    id="{{ $formId['CREATE_COMPANY_PROJECT_FORM'] }}"
    @submit.prevent="submit"
>

    @include('admin::company-projects.partials.company-project-form')

    <div class="modal-actions">
        <x-button.outline
            class="modal-close"
            label="Cancel"
            :data-custom-close="$modal['CREATE_COMPANY_PROJECT_MODAL']"
        />

        <x-button.main
            label="Submit"
            wire:target="handleSubmit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
