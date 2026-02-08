<footer class="py-4">
    <div class="container">
        <div class="row align-items-center g-3 justify-content-center justify-content-md-between">

            @php
                $landingRaw = \App\Models\LandingPage::with('translations')->get();

                $landing = [];
                foreach ($landingRaw as $item) {
                    $landing[$item->key] = $item->getTranslation($item->key);
                }
            @endphp

            <div class="col-md-4 text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                    <img src="{{ asset('frontend/assets/img/footer-icon.svg') }}" alt="Icon" class="me-2">
                    <p class="m-0">
                        {{ $landing['footer_text'] }}
                        {{-- <span>Softvence</span> --}}
                    </p>
                </div>
            </div>


            <div class="col-md-4 text-center text-md-end">
                <ul class="nav justify-content-center justify-content-md-end">
                    @php
                        $footerMenus = App\Models\Menu::with(['translations', 'page', 'language'])
                            ->where('status', 1)
                            ->where('position', 'footer')
                            ->orderBy('order', 'asc')
                            ->get();
                    @endphp

                    @foreach ($footerMenus as $menu)
                        <li class="nav-item">
                            <a class="nav-link px-2"
                                href="{{ $menu->menu_type === 'page' && $menu->page
                                    ? route('frontend.handle', $menu->page->page_slug)
                                    : ($menu->menu_type === 'language' && $menu->language
                                        ? url($menu->language->slug)
                                        : '#') }}">

                                {{ $menu->getTranslation('name') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</footer>
