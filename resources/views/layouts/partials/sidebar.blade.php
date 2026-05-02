<aside id="sidebar" class="sidebar">

    {{-- Brand --}}
    <div class="sidebar-top">
        <div class="sidebar-brand-icon">
            <i class="fi fi-sr-home"></i>
        </div>

        <span class="sidebar-brand-text">
            Admin Panel
        </span>
    </div>

    {{-- Scroll area --}}
    <div class="sidebar-scroll">

        {{-- Main nav --}}
        <div class="sidebar-section">
            <span class="sidebar-section-label">Main</span>

            <x-button.link
                class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                :href="route('admin.dashboard')"
                title="Dashboard"
            >
                <i class="fi fi-tr-chart-tree-map"></i>

                <span class="sidebar-item-label">
                    Dashboard
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>

            <x-button.link
                class="sidebar-item {{ request()->routeIs('admin.company-services.*') ? 'active' : '' }}"
                :href="route('admin.company-services.index')"
                title="Services"
            >
                <i class="fi fi-tc-person-carry-box"></i>

                <span class="sidebar-item-label">
                    Services
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>

            <x-button.link
                class="sidebar-item {{ request()->routeIs('admin.company-projects.*') ? 'active' : '' }}"
                :href="route('admin.company-projects.index')"
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

            <x-button.link
                class="sidebar-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}"
                :href="route('admin.contacts.index')"
                title="Contacts"
            >
                <i class="fi fi-tr-customer-service"></i>

                <span class="sidebar-item-label">
                    Contacts
                </span>

                <div class="sidebar-item-dot"></div>
            </x-button.link>
        </div>

    </div>

    {{-- User --}}
    <div class="sidebar-bottom">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ strtoupper(substr($user->full_name, 0, 2)) }}
            </div>

            <div class="sidebar-user-info">
                <div class="sidebar-user-name">
                    {{ $user->full_name  }}
                </div>

                <div class="sidebar-user-role badge">
                    Administrator
                </div>
            </div>
        </div>
    </div>

</aside>