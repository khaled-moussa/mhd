<form
    x-data="serviceFormCreateComponent"
    id="{{ $formId['CREATE_COMPANY_SERVICE_FORM'] }}"
    class="service-form"
    wire:submit.prevent="submit"
>
    @include('pages.panels.admin.company-services.partials.company-service-form')

    <div class="modal-actions">
        <x-button.outline
            class="modal-close"
            label="Cancel"
            :data-modal-id="$modalId['CREATE_COMPANY_SERVICE_MODAL']"
        />

        <x-button.main
            label="Submit"
            wire:target="submit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
