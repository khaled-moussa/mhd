<nav class="navbar">

    {{-- Menu toggle --}}
    <x-button.outlined
        id="navbar-side-expand-btn"
        class="toggle-btn"
    >
        <i class="fi fi-sr-menu-burger"></i>

        </x-button.outline>

        {{-- Brand --}}
        <div class="navbar-brand">
            {{ config('app.name') }}
        </div>

        {{-- Account dropdown btn --}}
        <div class="account-dropdown-btn">
            <x-button.dropdown
                id="account-dropdown-btn"
                data-dropdown-toggle="account-dropdown-menu"
            >

                <x-asset.img
                    folder="mockups"
                    img="profile.jpg"
                />
                <i class="fi fi-rs-angle-small-down"></i>
            </x-button.dropdown>
        </div>

        {{-- Account dropdown menu --}}
        <div
            id="account-dropdown-menu"
            class="dropdown-menu account-dropdown hidden"
        >

            <div class="account-dropdown-info">
                <p> {{ $user->full_name }}</p>
                <p> {{ $user->email }}</p>
            </div>

            {{-- Account dropdown content --}}
            <ul aria-labelledby="dropdown-btn">
                <li>
                    <x-button.link
                        label="Profile"
                    />
                </li>
                <li>
                    <x-button.link
                        label="Security"
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
                        
                        <x-button.link
                            class="outlined-btn sm full danger"
                            type="submit"
                            label="Logout"
                        />
                    </form>
                </li>
            </ul>
        </div>

</nav>
