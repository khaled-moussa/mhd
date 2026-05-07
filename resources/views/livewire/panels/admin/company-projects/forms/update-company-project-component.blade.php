<form
    id="{{ $formId['UPDATE_COMPANY_PROJECT_FORM'] }}"
    x-data="projectFormUpdateComponent"
    @submit.prevent="submit"
>

    {{-- Form --}}
    @include('admin::company-projects.partials.company-project-form')

    <div class="modal-actions">
        <x-button.outlined
            label="Cancel"
            :data-modal-id="$modalId['UPDATE_COMPANY_PROJECT_MODAL']"
        />

        <x-button.primary
            label="Submit"
            wire:target="handleSubmit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
