{{-- Account dropdown btn --}}
<div class="account-dropdown-btn">
    <x-button.dropdown
        id="account-dropdown-btn"
        data-dropdown-toggle="account-dropdown-menu"
    >
        <img src="{{ $user->avatar }}" />

        <i class="fi fi-rs-angle-small-down"></i>
    </x-button.dropdown>
</div>

{{-- Account dropdown menu --}}
<div
    id="account-dropdown-menu"
    class="dropdown-menu account-dropdown hidden"
>

    <div class="account-dropdown-info">
        <p> {{ $currentUser['full_name'] }} </p>
        <p> {{ $currentUser['email'] }} </p>
    </div>

    {{-- Account dropdown content --}}
    <ul aria-labelledby="dropdown-btn">
        <li>
            <x-button.link
                label="Profile"
                path="{{ route($panel . '.settings.profile') }}"
            />
        </li>
        <li>
            <x-button.link
                label="Security"
                path="{{ route($panel . '.settings.security') }}"
            />
        </li>
    </ul>

    <ul aria-labelledby="dropdown-btn">
        <li>
            <form
                action="{{ route('auth.logout') }}"
                method="POST"
            >
                @csrf
                {{-- <x-button.icon
                    class="link-btn danger"
                    type="submit"
                    label="Logout"
                /> --}}
            </form>
        </li>
    </ul>
</div>
