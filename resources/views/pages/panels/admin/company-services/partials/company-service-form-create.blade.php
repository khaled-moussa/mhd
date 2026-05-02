@props(['modalId', 'modalTitle', 'eyebrow' => null, 'description' => null, 'size' => 'md'])

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
            class="modal-container {{ $size }}"
            role="dialog"
            aria-modal="true"
            aria-labelledby="{{ $modalId }}-title"
        >
            {{-- Header --}}
            <header class="modal-header">
                <div class="modal-header-left">
                    @if ($eyebrow)
                        <span class="modal-eyebrow">{{ $eyebrow }}</span>
                    @endif
                    <h2
                        class="modal-title"
                        id="{{ $modalId }}-title"
                    >
                        {{ $modalTitle }}
                    </h2>
                </div>

                <button
                    class="modal-close"
                    data-custom-close="{{ $modalId }}"
                    aria-label="Close modal"
                ></button>
            </header>

            <div class="modal-divider"></div>

            {{-- Description --}}
            @if ($description)
                <p class="modal-description">{{ $description }}</p>
            @endif

            {{-- Content --}}
            <main
                class="modal-content"
                id="{{ $modalId }}-content"
            >
			
                {{-- Create service livewire component --}}
                <livewire:panels.admin.company-services.forms.company-service-form-create-component />
            </main>

            {{-- Footer --}}
            @isset($footer)
                <footer class="modal-footer">
                    {{ $footer }}
                </footer>
            @endisset

        </div>
    </div>
</div>
