<div
    x-data="companyProjectsComponent"
    class="company-projects"
>
    {{-- Projects table livewire component --}}
    <livewire:panels.admin.company-projects.pages.company-projects-component />

    {{-- Create project modal --}}
    @include('admin::company-projects.partials.company-project-form-create', [
        'modalId' => $modal['CREATE_COMPANY_PROJECT_MODAL'],
        'modalTitle' => 'Create Project',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
    ])

    {{-- Update project modal --}}
    @include('admin::company-projects.partials.company-project-form-update', [
        'modalId' => $modal['UPDATE_COMPANY_PROJECT_MODAL'],
        'modalTitle' => 'Update Project',
        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, rem!',
    ])
</div>
