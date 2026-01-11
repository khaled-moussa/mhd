<form
	x-data="updateTwoFactorFormComponent"
	id="update-two-factor-form"
	wire:submit.prevent="submit"
>
	<x-form.input
		type="password"
		label="Current password"
		wire:model="form.currentPassword"
		minlength="8"
		required
		error="form.currentPassword"
	>

		<x-button.icon
			class="show-password"
			icon="fi fi-tc-eye-crossed"
		/>
	</x-form.input>

	<div class="modal-actions">
		<x-button.outline
			class="modal-close"
			label="Close"
			:data-modal-id="$modal['UPDATE_TWO_FACTOR_MODAL']"
		/>

		<x-button.main
			id="submit-update-two-factor-btn"
			label="Contunie"
			wire:target="submit"
			wire:loading.class="spinner"
			wire:attr="disabled"
		/>
	</div>
</form>
