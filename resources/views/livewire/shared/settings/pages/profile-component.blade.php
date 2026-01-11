<div
    x-data="profileComponent"
    class="profile"
>
    <form
        class="profile-form"
        wire:submit.prevent="submit"
    >

        {{-- Content header --}}
        <header class="content-header">My Profile</header>

        {{-- Profile content --}}
        <div class="profile-content">

            {{-- View mode --}}
            <div
                x-show="!editing"
                x-cloak
            >
                @include('pages.shared.settings.profile.partials.profile-view')
            </div>

            {{-- Edit mode --}}
            <div
                x-show="editing"
                x-cloak
            >
                @include('pages.shared.settings.profile.partials.profile-edit')
            </div>
        </div>
    </form>
</div>
