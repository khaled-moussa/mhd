@props([
	'modalId', 
	'title', 
	'description' => null
])

<div class="modal" id="{{ $modalId }}" aria-hidden="true">
	<div class="modal-overlay" tabindex="-1" data-micromodal-close>
		<div class="modal-container lg" role="dialog" aria-modal="true" aria-labelledby="{{ $modalId }}-title">

			<header class="modal-header">
				{{-- Modal title --}}
				<h2 class="modal-title" id="{{ $modalId }}-title">
					{{ $title }}
				</h2>

				<x-button.outlined class="modal-close" :data-custom-close="$modalId" />
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
				<div class="modal-actions">
					<x-button.outlined
						label="Cancel"
						data-custom-close="{{ $modalId }}"
					/>

					<x-button.primary
						class="danger"
						label="Delete"
						data-confirm
						:attributes="$attributes->only(['wire:loading.class', 'wire:target'])"
					/>
				</div>
			</main>
		</div>
	</div>
</div>



