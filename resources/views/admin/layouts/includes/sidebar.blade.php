<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ route('website.index') }}">
            <img src="{{ setting('desktop_logo') ? asset('storage/' . setting('desktop_logo')) : asset('assets/admin/images/brand/logo.png') }}" class="header-brand-img desktop-lgo" alt="Azea logo">
            <img src="{{ setting('desktop_logo') ? asset('storage/' . setting('desktop_logo')) : asset('assets/admin/images/brand/logo1.png') }}" class="header-brand-img dark-logo" alt="Azea logo">
            <img src="{{ setting('mobile_logo') ? asset('storage/' . setting('mobile_logo')) : asset('assets/admin/images/brand/favicon.png') }}" class="header-brand-img mobile-logo" alt="Azea logo">
            <img src="{{ setting('mobile_logo') ? asset('storage/' . setting('mobile_logo')) : asset('assets/admin/images/brand/favicon1.png') }}" class="header-brand-img darkmobile-logo" alt="Azea logo">
        </a>
    </div>
    <ul class="side-menu app-sidebar3">

        <li class="slide {{ request()->is('admin/dashboard') ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                <i class="mdi mdi-home me-4 fs-20"></i>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>

        @can('country.view')
            <li class="slide {{ request()->is('admin/countries') || request()->is('admin/countries/*') ? 'is-expanded' : '' }}">
                <a class="side-menu__item {{ request()->is('admin/countries') || request()->is('admin/countries/*') ? 'active' : '' }}" href="{{ route('admin.countries.index') }}">
                    <i class="mdi mdi-earth me-4 fs-20"></i>
                    <span class="side-menu__label">Countries</span>
                </a>
            </li>
        @endcan

        @can('state.view')
            <li class="slide {{ request()->is('admin/states') || request()->is('admin/states/*') ? 'is-expanded' : '' }}">
                <a class="side-menu__item {{ request()->is('admin/states') || request()->is('admin/states/*') ? 'active' : '' }}" href="{{ route('admin.states.index') }}">
                    <i class="mdi mdi-flag me-4 fs-20"></i>
                    <span class="side-menu__label">States</span>
                </a>
            </li>
        @endcan

        @can('city.view')
            <li class="slide {{ request()->is('admin/cities') || request()->is('admin/cities/*') ? 'is-expanded' : '' }}">
                <a class="side-menu__item {{ request()->is('admin/cities') || request()->is('admin/cities/*') ? 'active' : '' }}" href="{{ route('admin.cities.index') }}">
                    <i class="mdi mdi-map-marker-multiple me-4 fs-20"></i>
                    <span class="side-menu__label">Cities</span>
                </a>
            </li>
        @endcan

        @can('user.view')
        <li class="slide {{ request()->is('admin/users') || request()->is('admin/roles/*') ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="mdi mdi-account-multiple me-4 fs-20"></i>
                <span class="side-menu__label">Users</span>
            </a>
        </li>
        @endcan

        @can('role.view')
        <li class="slide {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                <i class="mdi mdi-read me-4 fs-20"></i>
                <span class="side-menu__label">Roles</span>
            </a>
        </li>
        @endcan

        @can('media.view')
        <li class="slide {{ request()->is('admin/media') ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->is('admin/media') ? 'active' : '' }}" href="{{ route('admin.media.index') }}">
                <i class="mdi mdi-folder-multiple-image me-4 fs-20"></i>
                <span class="side-menu__label">Media</span>
            </a>
        </li>
        @endcan

        @can('setting.view')
        <li class="slide {{ request()->is('admin/settings/*') ? 'is-expanded' : '' }}">
            <a class="side-menu__item {{ request()->is('admin/settings/*') ? 'active' : '' }}" href="{{ route('admin.settings.index', 'general') }}">
                <i class="mdi mdi-apps me-4 fs-20"></i>
                <span class="side-menu__label">Settings</span>
            </a>
        </li>
        @endcan

    </ul>
</aside>
