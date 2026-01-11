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
			class="modal-container sm"
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
					:data-modal-id="$modalId"
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
				{{-- Secuirty update email form livewire component --}}
				<livewire:shared.settings.forms.update-email-form-component />
			</main>
		</div>
	</div>
</div>
