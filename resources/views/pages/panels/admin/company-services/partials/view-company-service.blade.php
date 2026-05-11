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

            <div class="modal-divider"></div>

            {{-- Modal content --}}
            <main
                class="modal-content"
                id="{{ $modalId }}-content"
            >
                <div
                    x-data="viewServiceComponent"
                    class="service-view"
                >
                    <div class="service-view-row">
                        {{-- Title --}}
                        <x-label.info
                            label="Title"
                            xDescription="serviceData.title"
                        />
                    </div>

                    <div class="service-view-row">
                        {{-- Description --}}
                        <x-label.info
                            label="Description"
                            xDescription="serviceData.description"
                        />
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
