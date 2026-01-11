<form
	x-data="updatePasswordFormComponent"
	id="update-password-form"
	wire:submit.prevent="submit"
>
	<x-form.input
		type="password"
		label="Current password"
		wire:model="currentPassword"
		minlength="8"
		required
		error="currentPassword"
	>

		<x-button.icon
			class="show-password"
			icon="fi fi-tc-eye-crossed"
		/>
	</x-form.input>

	<x-form.input
		type="password"
		label="New password"
		wire:model="newPassword"
		minlength="8"
		required
		error="newPassword"
	>

		<x-button.icon
			class="show-password"
			icon="fi fi-tc-eye-crossed"
		/>
	</x-form.input>

	<x-form.input
		type="password"
		label="Confirm password"
		wire:model="confirmationPassword"
		minlength="8"
		required
		error="confirmationPassword"
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
			:data-modal-id="$modal['UPDATE_PASSWORD_MODAL']"
		/>

		<x-button.main
			id="submit-update-password-btn"
			label="Contunie"
			wire:target="submit"
			wire:loading.class="spinner"
			wire:attr="disabled"
		/>
	</div>

</form>
