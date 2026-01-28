<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name }} | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($settings->favicon ?? '') }}">
    @yield('meta')
    @include('frontend.layouts.styles')
</head>

<body>

    <!-- Navbar Section -->
    @include('frontend.layouts.navbar')


    <main>
        @yield('content')
    </main>


    @if (!Route::is('frontend.editor'))
        @include('frontend.layouts.footer')
    @endif


    @include('frontend.layouts.scripts')

</body>

</html>
