<nav class="navbar--app">

    {{-- Left --}}
    <div class="navbar--app-left">

        {{-- Menu toggle --}}
        <x-button.outlined
            id="navbar-side-expand-btn"
            class="navbar--app-toggle"
        >
            <i class="fi fi-sr-menu-burger"></i>
        </x-button.outlined>

        {{-- Brand --}}
        <div class="navbar--app-brand">
            {{ config('app.name') }}
        </div>

    </div>

    {{-- Right --}}
    <div class="navbar--app-right">

        <div class="navbar--app-actions">

            {{-- Account dropdown btn --}}
            <div class="account-dropdown-btn">
                <x-button.dropdown
                    id="account-dropdown-btn"
                    data-dropdown-toggle="account-dropdown-menu"
                >
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr($user->full_name, 0, 2)) }}
                    </div>

                    <i class="fi fi-rs-angle-small-down"></i>
                </x-button.dropdown>
            </div>

        </div>

        {{-- Account dropdown menu --}}
        <div
            id="account-dropdown-menu"
            class="dropdown-menu account-dropdown hidden"
        >

            <div class="account-dropdown-info">
                <p>{{ $user->full_name }}</p>
                <p>{{ $user->email }}</p>
            </div>

            {{-- Links --}}
            <ul>
                <li>
                    <x-button.link label="Profile" />
                </li>
                <li>
                    <x-button.link label="Security" />
                </li>
            </ul>

            {{-- Logout --}}
            <ul>
                <li>
                    <form
                        action="{{ route('auth.logout') }}"
                        method="POST"
                    >
                        @csrf

                        <x-button.outlined
                            class="sm full danger"
                            type="submit"
                            label="Logout"
                        />
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
