<div
    x-data="projectsComponent"
    class="projects"
>
    {{-- Projects table livewire component --}}
    @livewire('panels.admin.company-projects.pages.company-projects-component')

    {{-- View project modal --}}
    @include('admin::company-projects.partials.view-company-project')

    {{-- Create project modal --}}
    @include('admin::company-projects.partials.create-company-project', [
        'modalId' => $modalId['CREATE_COMPANY_PROJECT_MODAL'],
        'modalTitle' => 'Create Project',
        'description' => 'Fill in the required information to create a new project and assign it to the company workspace.',
    ])

    {{-- Update project modal --}}
    @include('admin::company-projects.partials.update-company-project', [
        'modalId' => $modalId['UPDATE_COMPANY_PROJECT_MODAL'],
        'modalTitle' => 'Update Project',
        'description' => 'Modify existing project details such as name, status, timeline, and assigned data.',
    ])
</div>
