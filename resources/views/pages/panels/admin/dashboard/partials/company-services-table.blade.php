<div class="users">
    {{-- Company Services table livewire component --}}
    <livewire:panels.admin.company-services.pages.company-services-component />

    {{-- Create company service modal --}}
    @include('admin::company-services.partials.company-service-form-create', [
        'modalId' => $modal['CREATE_COMPANY_SERVICE_MODAL'],
        'modalTitle' => 'Create Service',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
    ])

    {{-- Update company service modal --}}
    @include('admin::company-services.partials.company-service-form-update', [
        'modalId' => $modal['UPDATE_COMPANY_SERVICE_MODAL'],
        'modalTitle' => 'Update Service',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
    ])
</div>
