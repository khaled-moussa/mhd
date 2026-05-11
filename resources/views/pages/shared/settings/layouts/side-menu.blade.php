<div class="side-menu">
    <ul>
        <li>
            <x-button.link
                label="My Profile"
                :href="route('admin.settings.profile')"
                wire:navigate.hover
                wire:current="active"
            />
        </li>

        <li>
            <x-button.link
                label="Security"
                :href="route('admin.settings.security')"
                wire:navigate
                wire:current="active"
            />
        </li>

        <li>
            <x-button.link
                label="Site Editor"
                :href="route('admin.settings.site-editor')"
                wire:navigate
                wire:current="active"
            />
        </li>
    </ul>
</div>
