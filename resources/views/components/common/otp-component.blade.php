@props(['model', 'target', 'error' => null])

<div x-data="otpComponent" class="otp">
	<x-form.input
		class="otp-merge"
		type="text"
		id="otp-input"
		name="otp"
		minlength="4"
		maxlength="4"
		:wire:model="$model"
		required
	/>

	{{-- OTP Input Slot --}}
	<x-form.otp />

	{{-- OTP validation --}}
	<x-alert.validation-input :error="$error" />

	{{-- Resend Section --}}
	<div class="resend-otp">
		<div>
			<p
				class="description"
				id="otp-timer-display"
				x-text="formattedTime"
			>
			</p>
		</div>

		{{-- Resend button --}}
		<x-button.outline
			class="resend-btn"
			id="resend-btn"
			label="Resend"
			:wire:target="$target"
			wire:loading.class="spinner"
			wire:loading.attr="disabled"
			x-bind:disabled="disableResendButton"
			@click="resendOtp"
		>
			<i class="fi fi-rr-rotate-left"></i>
		</x-button.outline>
	</div>

</div>
