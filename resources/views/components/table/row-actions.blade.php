@props(['index'])

<div
    x-data="{ open: false }"
	x-cloak
    class="table-row-actions relative"
>
    {{-- Toggle button --}}
    <x-button.dropdown
        class="table-row-actions__toggle"
        @click="open = !open"
        @keydown.escape.window="open = false"
        aria-haspopup="true"
        aria-expanded="false"
    >
        <div>
            <i class="fi fi-ss-menu-dots"></i>
        </div>
    </x-button.dropdown>

    {{-- Dropdown menu --}}
    <div
        x-show="open"
        x-transition.origin.top.right
        @click.outside="open = false"
        class="dropdown-menu table-row-actions__menu"
    >
        <ul class="table-row-actions__list">
            {{ $slot }}
        </ul>
    </div>
</div>
