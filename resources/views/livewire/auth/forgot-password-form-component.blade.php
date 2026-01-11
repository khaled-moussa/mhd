{{-- Forgot Password form --}}
<div>
	<form
		class="auth-form"
		id="forget-password-form"
		wire:submit.prevent="attemptForgetPassword"
	>
		{{-- Email --}}
		<x-form.input
			type="email"
			id="forget-email"
			placeholder="Ex. username@example.com"
			label="Email"
			wire:model="email"
			required
			:error="$errors->first('email')"
		/>

		{{-- Form validation --}}
		<x-alert.validation-input error="forget_password_failed" />

		<div class="form-actions row-end">
			{{-- Form actions --}}
			<x-button.main
				type="submit"
				id="forget-button"
				label="Change my Password"
				wire:loading.class="spinner"
				wire:target="attemptForgetPassword"
				wire:loading.attr="disabled"
			/>

			<x-button.link
				class="link-btn"
				label="No account?"
				:path="route('auth.login')"
				wire:navigate.hover
				wire:current="active"
			>

				<span class="underline">
					Login to my Account
				</span>
			</x-button.link>
		</div>
	</form>
</div>
