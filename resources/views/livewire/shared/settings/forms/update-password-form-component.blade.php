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

        <div class="show-password">
            <i class="fi fi-tc-eye-crossed"></i>
        </div>
    </x-form.input>

    <x-form.input
        type="password"
        label="New password"
        wire:model="newPassword"
        minlength="8"
        required
        error="newPassword"
    >

        <div class="show-password">
            <i class="fi fi-tc-eye-crossed"></i>
        </div>
    </x-form.input>

    <x-form.input
        type="password"
        label="Confirm password"
        wire:model="confirmationPassword"
        minlength="8"
        required
        error="confirmationPassword"
    >
        <div class="show-password">
            <i class="fi fi-tc-eye-crossed"></i>
        </div>
    </x-form.input>

    <div class="modal-actions">
        <x-button.outlined
            class="modal-close"
            label="Close"
            :data-modal-id="$modalId['UPDATE_PASSWORD_MODAL']"
        />

        <x-button.primary
            id="submit-update-password-btn"
            label="Contunie"
            wire:target="submit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>

</form>
