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

        <div class="show-password">
            <i class="fi fi-tc-eye-crossed"></i>
        </div>
    </x-form.input>

    <div class="modal-actions">
        <x-button.outlined
            class="modal-close"
            label="Close"
            :data-modal-id="$modalId['UPDATE_TWO_FACTOR_MODAL']"
        />

        <x-button.primary
            id="submit-update-two-factor-btn"
            label="Contunie"
            wire:target="submit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
