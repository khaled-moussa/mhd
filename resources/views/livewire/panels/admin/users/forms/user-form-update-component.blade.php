<form
    class="user-form"
    id="{{ $formId['UPDATE_USER_FORM'] }}"
    x-data="userFormUpdateComponent"
    @submit.prevent="submit"
>
    @include('admin::users.partials.user-form')

    <x-form.tags
        id="update-roles-input"
        label="Roles"
        wire:ignore
        required
        error="form.roles"
    />
    
    <div class="modal-actions">
        <x-button.outline
            class="modal-close"
            label="Cancel"
            :data-modal-id="$modal['UPDATE_USER_MODAL']"
        />

        <x-button.main
            label="Submit"
            wire:target="handleSubmit"
            wire:loading.class="spinner"
            wire:attr="disabled"
        />
    </div>
</form>
