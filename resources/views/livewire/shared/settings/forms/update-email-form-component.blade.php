<form
	x-data="updateEmailFormComponent"
	id="update-email-form"
	wire:submit.prevent="submit"
>
	{{-- Step 1 - Validate Password --}}
	@if ($form->is($form->step::PASSWORD_STEP))
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
	@endif

	{{-- Step 2 - Validate Email --}}
	@if ($form->is($form->step::EMAIL_STEP))
		<x-form.input
			type="email"
			label="Email"
			wire:model="form.newEmail"
			required
			error="form.newEmail"
		/>
	@endif

	{{-- Step 3 - Validate Verification Code --}}
	@if ($form->is($form->step::OTP_STEP))
		{{-- OTP Component --}}
		<x-common.otp-component
			model="form.otp"
			target="sendOtp"
			error="form.otp"
		/>
	@endif

	<div class="modal-actions">
		<x-button.outline
			class="modal-close"
			label="Close"
			:data-modal-id="$modal['UPDATE_EMAIL_MODAL']"
		/>

		<x-button.main
			id="submit-update-email-btn"
			label="Contunie"
			wire:target="submit"
			wire:loading.class="spinner"
			wire:attr="disabled"
			{{-- x-bind:disabled="disabledSubmitBtn" --}}
		/>
	</div>
</form>
