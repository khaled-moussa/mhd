@props(['modalId', 'modalTitle', 'description' => null])

<div
    class="modal"
    id="{{ $modalId }}"
    aria-hidden="true"
>
    <div
        class="modal-overlay"
        tabindex="-1"
        data-micromodal-close
    >
        <div
            class="modal-container xl"
            role="dialog"
            aria-modal="true"
            aria-labelledby="{{ $modalId }}-title"
        >
            <header class="modal-header">
                {{-- Modal title --}}
                <h2
                    class="modal-title"
                    id="{{ $modalId }}-title"
                >
                    {{ $modalTitle }}
                </h2>

                <x-button.outline
                    class="modal-close"
                    :data-custom-close="$modalId"
                />
            </header>

            {{-- Modal description --}}
            @if ($description)
                <p class="modal-description">
                    {{ $description }}
                </p>
            @endif

            {{-- Modal content --}}
            <main
                class="modal-content"
                id="{{ $modalId }}-content"
            >
                {{-- Create project livewire component --}}
                <livewire:panels.admin.company-projects.forms.company-project-form-create-component />
            </main>
        </div>
    </div>
</div>
