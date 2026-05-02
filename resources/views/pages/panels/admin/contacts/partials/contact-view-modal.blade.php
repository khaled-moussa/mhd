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

                <x-button.outlined
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
                <div class="service-view">
                    <div class="service-view-row">
                        {{-- Name --}}
                        <x-label.info
                            label="Name"
                            x-description="contactData.name"
                        />

                        {{-- Email --}}
                        <x-label.info
                            label="Email"
                            x-description="contactData.email"
                        />

                        {{-- Phone --}}
                        <x-label.info
                            label="Phone"
                            x-description="contactData.phone"
                        />
                    </div>
                    <div class="service-view-row">
                        {{-- Message --}}
                        <x-label.info
                            label="Message"
                            x-description="contactData.message"
                        />
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
