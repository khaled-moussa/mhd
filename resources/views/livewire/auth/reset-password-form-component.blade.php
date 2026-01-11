<div>
	<form
		class="auth-form"
		id="reset-password-form"
		wire:submit.prevent="attemptToChangePassword"
	>
		{{-- Email display --}}
		<x-label.info
			label="Email"
			description="{{ $email }}"
		/>

		{{-- New Password --}}
		<x-form.input
			type="password"
			id="reset-new-password"
			minlength="8"
			placeholder="********"
			label="New Password"
			wire:model="newPassword"
			required
			:error="$errors->first('newPassword')"
		>
			<x-button.icon
				class="show-password"
				icon="fi fi-tc-eye-crossed"
			/>
		</x-form.input>

		{{-- Confirm Password --}}
		<x-form.input
			type="password"
			id="reset-confirm-password"
			minlength="8"
			placeholder="********"
			label="Confirm Password"
			wire:model="passwordConfirmation"
			required
			:error="$errors->first('passwordConfirmation')"
		>
			<x-button.icon
				class="show-password"
				icon="fi fi-tc-eye-crossed"
			/>
		</x-form.input>

		{{-- Form validation --}}
		<x-alert.validation-input error="reset_password_failed" />

		{{-- Form actions --}}
		<div class="form-actions row-end">
			<x-button.main
				type="submit"
				id="reset-button"
				label="Reset Password"
				wire:loading.class="spinner"
				wire:target="attemptToChangePassword"
				wire:loading.attr="disabled"
			/>

			@error('reset_password_failed')
				<x-button.link
					class="outline-btn"
					id="home-button"
					label="Return to Home"
					:path="route('auth.login')"
				/>
			@enderror
		</div>
	</form>
</div>
