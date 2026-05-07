<form
    id="{{ $formId['CREATE_COMPANY_PROJECT_FORM'] }}"
    x-data="projectFormCreateComponent"
    @submit.prevent="submit"
>
    {{-- Form --}}
    @include('admin::company-projects.partials.company-project-form')

    <div class="modal-actions">
        <x-button.outlined
            class="modal-close"
            label="Cancel"
            :data-modal-id="$modalId['CREATE_COMPANY_PROJECT_MODAL']"
        />

        <x-button.primary
            label="Submit"
            wire:target="handleSubmit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
