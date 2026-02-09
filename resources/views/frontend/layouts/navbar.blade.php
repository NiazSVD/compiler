<nav class="navbar navbar-expand-md">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
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
                    <a class="nav-link" href="{{ url('/') }}">
                        {{ app()->getLocale() == 'bn' ? 'হোম' : 'Home' }}
                    </a>
                </li>

                @if (!($homeSettings && $homeSettings->type === 'page' && $homeSettings->slug === 'landing'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing.home') }}">
                            {{ app()->getLocale() == 'bn' ? 'সব ভাষা' : 'All Languages' }}
                        </a>
                    </li>
                @endif

                @php
                    $menus = App\Models\Menu::with(['translations', 'page', 'language'])
                        ->where('status', 1)
                        ->where('position', 'header')
                        ->orderBy('order', 'asc')
                        ->get();
                @endphp

                @forelse ($menus as $menu)
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ $menu->menu_type === 'page' && $menu->page
                                ? route('frontend.handle', $menu->page->page_slug)
                                : ($menu->menu_type === 'language' && $menu->language
                                    ? url($menu->language->slug)
                                    : '#') }}">

                            {{ $menu->getTranslation('name') }}
                        </a>
                    </li>
                @empty
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            {{ app()->getLocale() == 'bn' ? 'কোন মেনু নেই' : 'No Menu Available' }}
                        </a>
                    </li>
                @endforelse

                <li class="nav-item dropdown">
                    @php
                        // ডাটাবেস থেকে সব ল্যাঙ্গুয়েজ একবারে নিয়ে আসা হচ্ছে পারফরম্যান্সের জন্য
                        $dbLanguages = \App\Models\MultiLang::where('active', 1)->get()->keyBy('code');
                        $currentLocale = app()->getLocale();
                        $currentLangData = $dbLanguages[$currentLocale] ?? null;
                    @endphp

                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="languageDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        @if ($currentLangData && $currentLangData->flag)
                            <img src="{{ asset('uploads/flag/' . $currentLangData->flag) }}" class="me-1"
                                style="width: 20px; height: 13px; object-fit: cover; border-radius: 2px;">
                        @else
                            <i class="bi bi-translate me-1"></i>
                        @endif

                        {{ strtoupper($currentLocale) }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @php
                            $supportedLocales = LaravelLocalization::getSupportedLocales();
                        @endphp

                        @foreach ($supportedLocales as $localeCode => $properties)
                            @php
                                $langInfo = $dbLanguages[$localeCode] ?? null;
                            @endphp
                            <li>
                                <a class="dropdown-item {{ $currentLocale == $localeCode ? 'active' : '' }} d-flex align-items-center"
                                    rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                                    @if ($langInfo && $langInfo->flag)
                                        <img src="{{ asset('uploads/flag/' . $langInfo->flag) }}" class="me-2"
                                            style="width: 20px; height: 13px; object-fit: cover; border-radius: 2px;">
                                    @else
                                        <i class="bi bi-translate me-2"></i>
                                    @endif

                                    {{ $properties['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-translate"></i> {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @php
                            $supportedLocales = LaravelLocalization::getSupportedLocales();
                        @endphp

                        @foreach ($supportedLocales as $localeCode => $properties)
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == $localeCode ? 'active' : '' }}"
                                    rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li> --}}

            </ul>
        </div>


    </div>
</nav>
