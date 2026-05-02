@props([
	'modalId', 
	'modalTitle', 
	'description' => null
])

<div class="modal" id="{{ $modalId }}" aria-hidden="true">
    <div class="modal-overlay" tabindex="-1" data-micromodal-close>
        <div class="modal-container xl" role="dialog" aria-modal="true" aria-labelledby="{{ $modalId }}-title">

            {{-- Modal header --}}
            <header class="modal-header">
                <h2 class="modal-title" id="{{ $modalId }}-title">
                    {{ $modalTitle }}
                </h2>

                <x-button.outlined 
					class="modal-close" 
					:data-custom-close="$modalId" />
            </header>

            {{-- Modal description --}}
            @if ($description)
                <p class="modal-description">
                    {{ $description }}
                </p>
            @endif

            <div class="modal-divider"></div>

            {{-- Modal content --}}
            <main class="modal-content" id="{{ $modalId }}-content">
                {{-- Create project livewire component --}}
                @livewire('panels.admin.company-projects.forms.create-company-project-component')
            </main>
        </div>
    </div>
</div>