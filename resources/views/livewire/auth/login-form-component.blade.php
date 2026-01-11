<div>
	<form
		class="auth-form"
		id="login-form"
		wire:submit.prevent="attemptLogin"
	>
		{{-- Email --}}
		<x-form.input
			type="email"
			id="login-email"
			placeholder="Ex. username@example.com"
			label="Email"
			wire:model="email"
			required
			error="email"
		/>

		{{-- Password --}}
		<x-form.input
			type="password"
			id="login-password"
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

		<div class="row">
			{{-- Remember checkbox --}}
			<x-form.checkbox
				label="Remember login"
				wire:model="remember"
				error="remember"
			/>

			{{-- Forgot password link --}}
			<x-button.link
				class="link-btn forget-password"
				label="Forgot password?"
				:path="route('auth.forgot-password')"
				wire:navigate.hover
				wire:current="active"
			/>
		</div>

		{{-- Form validation --}}
		<x-alert.validation-input error="login_failed" />

		{{-- Form actions --}}
		<div class="form-actions">
			<x-button.main
				type="submit"
				id="login-button"
				label="Sign In"
				wire:loading.class="spinner"
				wire:target="attemptLogin"
				wire:loading.attr="disabled"
			>
				<i class="fi fi-tr-entrance"></i>
			</x-button.main>

			<x-button.link
				class="link-btn"
				label="No account?"
				:path="route('auth.register')"
				wire:navigate.hover
				wire:current="active"
			>
				<span class="underline">Create an account</span>
			</x-button.link>
		</div>
	</form>
</div>
