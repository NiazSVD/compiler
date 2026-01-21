<footer class="py-4">
    <div class="container">
        <div class="row align-items-center g-3 justify-content-center justify-content-md-between">

            @php
                $menus = App\Models\Menu::where('status', 1)
                    ->where('position', 'footer')
                    ->orderBy('order', 'asc')
                    ->get();
                $landingRaw = DB::table('landing_pages')->get();

                $landing = [];
                foreach ($landingRaw as $item) {
                    $landing[$item->key] = $item->value;
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
                    @forelse ($menus as $menu)
                        <li class="nav-item">
                            <a class="nav-link px-2"
                                href="{{ $menu->menu_type === 'page' && $menu->page
                                    ? route('frontend.handle', $menu->page->page_slug)
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
    </div>
</footer>
