<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="{{ route('dashboard') }}">
        <img class="navbar-brand-dark" src="{{ asset($settings->logo ?? '') }}" alt="{{ $settings->site_name ?? '' }}" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">

        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="{{ asset('backend/assets/img/team/profile-picture-3.jpg') }}"
                        class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">{{ __('messages.hi') }}, {{ Auth::user()->name }}</h2>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                        <i class="bi bi-box-arrow-right icon-xxs me-1"></i>
                        {{ __('messages.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <i class="bi bi-x-lg icon-xs"></i>
                </a>
            </div>
        </div>

        <a class="logo d-none d-md-block">
            <img src="{{ asset($settings->logo ?? '') }}" alt="{{ $settings->site_name ?? '' }}"
                class="w-100 logo-white">
        </a>

        <ul class="nav flex-column pt-3 pt-md-0">

            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="sidebar-icon"><i class="bi bi-speedometer2 me-2"></i></span>
                    <span class="sidebar-text">{{ __('messages.dashboard') }}</span>
                </a>
            </li>



            <li class="nav-item {{ request()->routeIs('admin.languages.*') ? 'active' : '' }}">
                <a href="{{ route('admin.languages.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="bi bi-translate me-2"></i>
                    </span>
                    <span class="sidebar-text">{{ __('Languages') }}</span>
                </a>
            </li>

            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>

            <li class="nav-item {{ request()->routeIs('admin.landing.*') ? 'active' : '' }}">
                <a href="{{ route('admin.landing.index') }}" class="nav-link">
                    <span class="sidebar-icon"><i class="bi bi-layout-text-sidebar-reverse me-2"></i></span>
                    <span class="sidebar-text">{{ __('Landing Page') }}</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.dynamic_page.*') ? 'active' : '' }}">
                <a href="{{ route('admin.dynamic_page.index') }}" class="nav-link">
                    <span class="sidebar-icon"><i class="bi bi-layout-text-sidebar-reverse me-2"></i></span>
                    <span class="sidebar-text">{{ __('Dynamic Pages') }}</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.dynamic_home.*') ? 'active' : '' }}">
                <a href="{{ route('admin.dynamic_home.index') }}" class="nav-link">
                    <span class="sidebar-icon"><i class="bi bi-layout-text-sidebar-reverse me-2"></i></span>
                    <span class="sidebar-text">{{ __('Dynamic Home') }}</span>
                </a>
            </li>

             <li class="nav-item {{ request()->routeIs('admin.menu') ? 'active' : '' }}">
                <a href="{{ route('admin.menu') }}" class="nav-link">
                    <span class="sidebar-icon"><i class="bi bi-layout-text-sidebar-reverse me-2"></i></span>
                    <span class="sidebar-text">{{ __('Menu Setting') }}</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('settings*') ? 'active' : '' }}">
                <a href="{{ route('settings') }}" class="nav-link">
                    <span class="sidebar-icon"><i class="bi bi-gear me-2"></i></span>
                    <span class="sidebar-text">{{ __('messages.settings') }}</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <a href="{{ route('profile') }}" class="nav-link">
                    <span class="sidebar-icon"><i class="bi bi-person-circle me-2"></i></span>
                    <span class="sidebar-text">{{ __('messages.profile') }}</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
