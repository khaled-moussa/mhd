<div class="notification-settings">

    {{-- Content header --}}
    <header class="content-header">
        Notifications
    </header>

    <div class="notification-content">
        {{-- Desktop notification --}}
        <x-label.info
            label="Enable desktop notification"
            description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, fuga."
        >

            <x-form.toggle
                wire:click="updateDesktopNotificationState"
                wire:model="desktopNotificationState"
            />
        </x-label.info>

        {{-- Email notification --}}
        <x-label.info
            label="Enable email notification"
            description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, fuga."
        >

            <x-form.toggle
                wire:click="updateEmailNotificationState"
                wire:model="emailNotificationState"
            />
        </x-label.info>
    </div>
</div>
