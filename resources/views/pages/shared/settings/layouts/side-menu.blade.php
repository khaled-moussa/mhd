<div class="side-menu">
    <ul>
        <li>
            <x-button.link
                label="My Profile"
                path="{{ route(name: $panel . '.settings.profile') }}"
                wire:navigate.hover
                wire:current="active"
            />
        </li>

        <li>
            <x-button.link
                label="Security"
                path="{{ route($panel . '.settings.security') }}"
                wire:navigate
                wire:current="active"
            />
        </li>

        <li>
            <x-button.link
                label="Site Editor"
                path="{{ route($panel . '.settings.site-editor') }}"
                wire:navigate
                wire:current="active"
            />
        </li>
    </ul>
</div>
