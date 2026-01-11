<form
	x-data="deleteAccountFormComponent"
	id="delete-account-form"
	wire:submit.prevent="submit"
>
	{{-- Step 1 - Validate Password --}}
	@if ($form->is($form->step::PASSWORD_STEP))
		<p class="modal-description">
			Enter a current password for your account to confirm delete.
		</p>

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

	{{-- Step 2 - Validate Verification Code --}}
	@if ($form->is($form->step::OTP_STEP))
		<p class="modal-description">
			Enter the 4-digit verification code sent to your email to confirm account deletion.
		</p>

		{{-- OTP Component --}}
		<x-common.otp-component
			model="form.otp"
			target="sendOtp"
			error="form.otp"
		/>
	@endif

	{{-- Step 3 - Alert --}}
	@if ($form->is($form->step::ACCOUNT_DELETED))
		<div class="flex flex-col gap-5">
			<div class="flex items-center gap-2">
				<h2>Your account has been deleted</h2>
				<i class="fi fi-sr-octagon-check text-green-500"></i>
			</div>

			<p>We’re sad to see you leave. You can always return anytime.</p>

			<x-button.outline
				label="Return to Login"
				wire:click="logout"
			/>
		</div>
	@endif

	<div class="modal-actions">
		<x-button.outline
			class="modal-close"
			label="Close"
			:data-modal-id="$modal['DELETE_ACCOUNT_MODAL']"
		/>

		<x-button.main
			id="submit-delete-account-btn"
			label="Contunie"
			wire:target="submit"
			wire:loading.class="spinner"
			wire:attr="disabled"
			{{-- x-bind:disabled="disabledSubmitBtn" --}}
		/>
	</div>
</form>
