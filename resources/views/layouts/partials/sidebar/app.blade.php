{{-- Sidebar --}}
<aside
    id="sidebar"
    class="sidebar"
>

    {{-- Brand --}}
    <div class="sidebar-top">
        <div class="sidebar-brand-icon">
            <i class="fi fi-sr-home"></i>
        </div>

        <span class="sidebar-brand-text">
            Admin Panel
        </span>
    </div>

    {{-- Scroll Area --}}
    <div class="sidebar-scroll">

        {{-- Main --}}
        <div class="sidebar-section">
            <span class="sidebar-section-label">Main</span>

            {{-- Dashboard --}}
            <x-button.link
                :href="route('admin.dashboard')"
                class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                title="Dashboard"
            >
                <i class="fi fi-tr-chart-tree-map"></i>

                <span class="sidebar-item-label">
                    Dashboard
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>

            {{-- Services --}}
            <x-button.link
                :href="route('admin.company-services.index')"
                class="sidebar-item {{ request()->routeIs('admin.company-services.*') ? 'active' : '' }}"
                title="Services"
            >
                <i class="fi fi-tc-person-carry-box"></i>

                <span class="sidebar-item-label">
                    Services
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>

            {{-- Projects --}}
            <x-button.link
                :href="route('admin.company-projects.index')"
                class="sidebar-item {{ request()->routeIs('admin.company-projects.*') ? 'active' : '' }}"
                title="Projects"
            >
                <i class="fi fi-tr-visit"></i>

                <span class="sidebar-item-label">
                    Projects
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>
        </div>

        {{-- Communication --}}
        <div class="sidebar-section">
            <span class="sidebar-section-label">Communication</span>

            {{-- Contacts --}}
            <x-button.link
                :href="route('admin.contacts.index')"
                class="sidebar-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}"
                title="Contacts"
            >
                <i class="fi fi-tr-customer-service"></i>

                <span class="sidebar-item-label">
                    Contacts
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>
        </div>

        {{-- Settings --}}
        <div class="sidebar-section">
            <span class="sidebar-section-label">Settings</span>

            {{-- Profile --}}
            <x-button.link
                :href="route('admin.settings.profile')"
                class="sidebar-item {{ request()->routeIs('admin.settings.profile') ? 'active' : '' }}"
                title="Profile Settings"
            >
                <i class="fi fi-rr-user"></i>

                <span class="sidebar-item-label">
                    Profile
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>

            {{-- Security --}}
            <x-button.link
                :href="route('admin.settings.security')"
                class="sidebar-item {{ request()->routeIs('admin.settings.security') ? 'active' : '' }}"
                title="Security Settings"
            >
                <i class="fi fi-tr-shield-check"></i>

                <span class="sidebar-item-label">
                    Security
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>
        </div>

    </div>

    {{-- Logout --}}
    <div class="sidebar-bottom">
        <form
            action="{{ route('auth.logout') }}"
            method="POST"
        >
            @csrf

            <button type="submit" class="sidebar-item">
                <i class="fi fi-tc-arrow-left-from-line"></i>

                <span class="sidebar-item-label">
                    Logout
                </span>
            </button>
        </form>
    </div>
</aside>
