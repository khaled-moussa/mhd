{{-- Password --}}
<x-form.input
    :id="$attributes->get('id')"
    type="password"
    label="Password"
    placeholder="••••••••"
    :wire:model="$attributes->get('wire:model')"
    autocomplete="current-password"
    required
    :error="$attributes->get('error')"
>
    <x-button.icon
        class="show-password"
        onclick="showPassword(event)"
    >
        <i class="fi fi-tc-eye-crossed"></i>
    </x-button.icon>
</x-form.input>
