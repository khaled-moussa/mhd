<form 
    x-data="companyServiceFormCreateComponent" 
    id="create-service-form" 
    class="service-form" 
    wire:submit.prevent="submit"
>
    @include('pages.panels.admin.company-services.partials.company-service-form')

    <div class="modal-actions">
        <x-button.outline 
            class="modal-close" 
            label="Cancel" 
            :data-custom-close="$modal['CREATE_COMPANY_SERVICE_MODAL']"
        />

        <x-button.main 
            label="Submit" 
            wire:target="submit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
