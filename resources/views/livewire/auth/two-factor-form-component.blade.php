<div x-data="twoFactorComponent">
	<form
		class="auth-form"
		id="two-factor-auth-form"
		wire:submit.prevent="submit"
	>
		{{-- OTP Component --}}
		<x-common.otp-component
			model="otp"
			target="sendOtp"
			error="otp"
		/>

		{{-- Form Actions --}}
		<div class="form-actions row-end">
			<x-button.outline
				id="logout-btn"
				label="Logout"
				wire:click="logout"
				wire:loading.class="spinner"
				wire:target="logout"
				wire:loading.attr="disabled"
			/>

			<x-button.main
				type="submit"
				id="two-factor-submit-btn"
				label="Verify Code"
				wire:target="submit"
				wire:loading.class="spinner"
				wire:loading.attr="disabled"
			/>
		</div>
	</form>
</div>
