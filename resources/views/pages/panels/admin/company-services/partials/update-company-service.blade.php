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
            class="modal-container lg"
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

                <x-button.icon
                    class="modal-close-btn"
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
                {{-- Update service livewire component --}}
                @livewire('panels.admin.company-services.forms.update-company-service-component')
            </main>
        </div>
    </div>
</div>
