<div>
	<form
		class="auth-form"
		id="register-form"
		wire:submit.prevent="attemptRegister"
	>
		<div class="row-input">
			{{-- First name --}}
			<x-form.input
				id="register-first-name"
				placeholder="Ex. John"
				label="First name"
				wire:model="firstName"
				required
				error="firstName"
			/>

			{{-- Last name --}}
			<x-form.input
				id="register-last-name"
				placeholder="Ex. Doe"
				label="Last name"
				wire:model="lastName"
				required
				error="lastName"
			/>
		</div>

		{{-- Email --}}
		<x-form.input
			type="email"
			id="register-email"
			placeholder="Ex. username@example.com"
			label="Email"
			wire:model="email"
			required
			error="email"
		/>

		{{-- Password --}}
		<x-form.input
			type="password"
			id="register-password"
			minlength="8"
			placeholder="********"
			label="Password"
			wire:model="password"
			required
			error="password"
		>
			<x-button.icon
				class="show-password"
				icon="fi fi-tc-eye-crossed"
			/>
		</x-form.input>

		{{-- Confirm password --}}
		<x-form.input
			type="password"
			id="register-confirm-password"
			minlength="8"
			placeholder="********"
			label="Confirm Password"
			wire:model="passwordConfirmation"
			required
			error="passwordConfirmation"
		>
			<x-button.icon
				class="show-password"
				icon="fi fi-tc-eye-crossed"
			/>
		</x-form.input>

		{{-- Privacy policy check --}}
		<x-form.checkbox
			wire:model="acceptTermsAndPrivacy"
			required
			error="acceptTermsAndPrivacy"
		>
			<div>
				By creating an account, you agree to the
				<x-button.link
					label="Terms of Use"
					class="underline"
				/>
				&
				<x-button.link
					label="Privacy Policy"
					class="underline"
				/>.
			</div>
		</x-form.checkbox>

		{{-- Form validation --}}
		<x-alert.validation-input error="register_failed" />

		{{-- Form actions --}}
		<div class="form-actions">
			<x-button.main
				type="submit"
				id="register-button"
				label="Create an Account"
				wire:loading.class="spinner"
				wire:target="attemptRegister"
				wire:loading.attr="disabled"
			/>

			<x-button.link
				class="link-btn"
				label="Already have an account?"
				:path="route('auth.login')"
				wire:navigate.hover
				wire:current="active"
			>
				<span class="underline">Sign In</span>
			</x-button.link>
		</div>
	</form>
</div>
