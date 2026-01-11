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
				<div class="service-view">
					<div class="service-view-row">
						{{-- Title --}}
						<x-label.info
							label="Title"
							:description="$form->title"
						/>
					</div>
					<div class="service-view-row">
						{{-- Description --}}
						<x-label.info
							label="Description"
							:description="$form->description"
						/>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>
