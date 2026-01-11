@props([
    'label',
    'route',
    'icon',
    'active' => false,
])

<li>
    <x-button.link
        :label="$label"
        :path="$route"
        @class(['active' => $active])
    >
        <x-slot:icon>
            <i class="{{ $icon }}"></i>
        </x-slot:icon>
    </x-button.link>
</li>
