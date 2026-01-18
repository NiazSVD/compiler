<nav class="navbar navbar-expand-md">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Logo">
            {{-- <img src="{{ asset($settings->logo) }}" alt="Logo"> --}}
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                @php
                    $menus = App\Models\Menu::where('status', 1)
                        ->where('position', 'header')
                        ->orderBy('order', 'asc')
                        ->get();
                @endphp

                @forelse ($menus as $menu)
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ $menu->menu_type === 'page' && $menu->page
                                ? route('dynamic.page', $menu->page->page_slug)
                                : ($menu->menu_type === 'language' && $menu->language
                                    ? url($menu->language->slug)
                                    : '#') }}">
                            {{ $menu->menu_type === 'page' && $menu->page
                                ? $menu->page->page_title
                                : ($menu->menu_type === 'language' && $menu->language
                                    ? $menu->language->display_name
                                    : 'No Page Selected') }}
                        </a>
                    </li>
                @empty
                    <li class="nav-item">
                        <a class="nav-link" href="#">No Page Selected</a>
                    </li>
                @endforelse

            </ul>
        </div>
    </div>
</nav>
