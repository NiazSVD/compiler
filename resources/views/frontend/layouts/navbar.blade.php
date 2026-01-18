<nav class="navbar navbar-expand-md">
    <div class="container">
        <a class="navbar-brand" href="#">
            {{-- <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Logo"> --}}
            <img src="{{ asset($settings->logo) }}" alt="Logo">
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                @php
                    $pages = App\Models\DynamicPage::get();
                @endphp

                @forelse ($pages as $page)
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('frontend.editor', $page->page_slug) }}">{{ $page->page_title }}</a>
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
