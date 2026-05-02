<div
    x-data="servicesComponent"
    class="services"
>
    {{-- Services table livewire component --}}
    @livewire('panels.admin.company-services.pages.company-services-component')

    {{-- View service modal --}}
    @include('admin::company-services.partials.view-company-service', [
        'modalId' => $modalId['VIEW_COMPANY_SERVICE_MODAL'],
        'modalTitle' => 'Service Details',
        'description' => 'View full details of the selected service including pricing, status, and related information.',
    ])

    {{-- Create service modal --}}
    @include('admin::company-services.partials.create-company-service', [
        'modalId' => $modalId['CREATE_COMPANY_SERVICE_MODAL'],
        'modalTitle' => 'Create New Service',
        'description' => 'Fill in the required information to add a new service to the company offerings.',
    ])

    {{-- Update service modal --}}
    @include('admin::company-services.partials.update-company-service', [
        'modalId' => $modalId['UPDATE_COMPANY_SERVICE_MODAL'],
        'modalTitle' => 'Update Service',
        'description' => 'Modify existing service details such as name, pricing, and visibility status.',
    ])
</div>