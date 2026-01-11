<div class="security">
    {{-- Content Header --}}
    <header class="content-header">
        Security
    </header>

    <div class="security-content">
        {{-- Email --}}
        <x-label.info
            label="Email"
            description="Manage your account email address and keep it up to date for login and notifications."
        >
            <x-label.info
                :label="$userData['email']"
                :placeholder="false"
            />

            <x-button.outline
                class="modal-open"
                data-modal-id="update-email-modal"
                label="Edit"
            >
                <i class="fi fi-rr-pencil"></i>
            </x-button.outline>
        </x-label.info>

        {{-- Password --}}
        <x-label.info
            label="Password"
            description="Update your account password to maintain strong account protection."
        >
            <x-button.outline
                class="modal-open"
                label="Edit"
                data-modal-id="update-password-modal"
            >
                <i class="fi fi-rr-pencil"></i>
            </x-button.outline>
        </x-label.info>

        {{-- Two Step Verification --}}
        <x-label.info
            label="2-step verification"
            description="Add an extra layer of security by requiring a verification code when signing in."
        >
            <x-button.outline
                class="modal-open"
                :label="$twoFactorStateLabel"
                data-modal-id="update-two-factor-modal"
            >
                <i class="fi fi-ts-shield-check"></i>
            </x-button.outline>
        </x-label.info>

        {{-- Google Sign --}}
        <x-label.info
            label="Google Sign"
            description="Add an extra layer of security by requiring a verification code when signing in."
            :badgelabel="$googleSignState->stateLabel()"
            :badgecolor="$googleSignState->color()"
        >
            <x-button.outline
                :label="$googleSignState->label()"
                wire:loading.class='spinner'
                wire:target='handleLinkingWithGoogle'
                wire:click="handleLinkingWithGoogle"
            >
                <i class="fi fi-brands-google"></i>
                </x-button.link>
        </x-label.info>

        {{-- Delete Account --}}
        <x-label.info
            label="Delete Account"
            description="Permanently remove your account and all associated data from our system."
        >
            <x-button.main
                class="modal-open danger"
                label="Delete Account"
                data-modal-id="delete-account-modal"
            />
        </x-label.info>
    </div>
</div>
