@props(['id', 'title', 'header', 'description' => null])

<div
	class="modal"
	id="{{ $id }}"
	aria-hidden="true"
	{{ $attributes->whereStartsWith('wire:ignore') }}
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
			aria-labelledby="{{ $id }}-title"
		>
			<header class="modal-header">
				{{-- Model title --}}
				<h2
					class="modal-title"
					id="{{ $id }}-title"
				>
					{{ $title }}
				</h2>

				<x-button.outline
					class="modal-close"
					data-custom-close="{{ $id }}"
				/>
			</header>

			{{-- Modal content --}}
			<main
				class="modal-content"
				id="{{ $id }}-content"
			>
				{{-- Modal header --}}
				<header class="modal-header">
					{{ $header }}
				</header>

				@if ($description)
					<p class="modal-description">
						{{ $description }}
					</p>
				@endif

				<div class="modal-actions">
					<x-button.outline
						label="Cancel"
						data-custom-close="{{ $id }}"
					/>

					<x-button.main
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
