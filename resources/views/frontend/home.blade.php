<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name ?? 'SVD Delta' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset($settings->favicon ?? '') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons (Bootstrap Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Lato:wght@300;400&display=swap"
        rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            font-family: 'Roboto', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            padding-top: 56px;
            background-color: #f8f9fa;
        }

        main {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        .language-card {
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            min-height: 150px;
            /* Reduced the height */
            padding: 1rem;
            /* Added padding to control spacing */
        }

        .language-card:hover {
            transform: translateY(-5px);
            /* Reduced hover effect */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            /* Reduced shadow size */
        }

        .language-icon {
            font-size: 40px;
            /* Reduced icon size */
            color: #0d6efd;
        }

        .card-title {
            font-size: 1.1rem;
            /* Reduced font size */
        }

        .card-body {
            padding: 1rem;
            /* Reduced padding inside the card */
        }

        /* Adjust the card column size for smaller screens */
        .col-12.col-sm-6.col-md-4.col-lg-3 {
            max-width: 220px;
            /* Set a max width for the cards */
        }

        .navbar-brand {
            font-family: 'Lato', sans-serif;
            font-weight: 700;
        }

        .hero-section {
            background: #007bff;
            color: white;
            padding: 5rem 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 1.25rem;
        }

        .footer-link {
            color: #fff;
            margin-right: 1rem;
        }

        .footer-link:hover {
            color: #ddd;
        }

        .search-input {
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
        }

        .search-input:focus {
            border-color: #007bff;
        }

        .footer {
            background-color: #007bff;
            padding: 2rem 0;
            text-align: center;
        }

        .footer .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .footer p {
            margin-bottom: 0;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        /* New section styling */
        .language-description {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #f1f1f1;
            border-radius: 8px;
        }
    </style>
</head>

<body style="background-color: {{ $landing->body_color ?? '#007bff' }}">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top"
        style="background-color: {{ $landing->header_color ?? '#007bff' }}">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset($settings->logo) }}"
                    style="filter: brightness(0) invert(1);"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Main content -->
    <main>
        <!-- Hero Section -->
        <section class="hero-section" style="background-color: {{ $landing->hero_color ?? '#007bff' }}">
            <div class="container">
                <h1 class="display-4 fw-bold">{{ $landing->header_text ?? 'Choose Your Programming Language' }}</h1>
                <p class="lead mb-4">
                    {{ $landing->header_description ?? 'Click on a language to write and run code online instantly.' }}
                </p>
            </div>
        </section>

        <!-- Search Section -->
        <section class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <input type="text" id="languageSearch" class="form-control search-input"
                        placeholder="Search Language...">
                </div>
            </div>
        </section>

        <!-- Languages Grid -->
        <section class="container pb-5">
            <div class="row g-4 justify-content-center" id="languagesGrid">
                @foreach ($languages as $lang)
                    @if ($lang->is_active)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card text-center language-card"
                                onclick="window.location.href='{{ route('frontend.editor', $lang->slug) }}'"
                                style="background-color: {{ $landing->language_color ?? '#007bff' }}">
                                <div class="card-body d-flex flex-column justify-content-center">
                                    <i class="{{ $lang->icon ?? 'fa-solid fa-code' }}"
                                        style="color: {{ $lang->icon_color ?? '#000' }}; font-size: 50px;"></i>
                                    <h5 class="card-title mt-2">{{ $lang->display_name }}</h5>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>

        <section class="container mb-5">
            <div class="language-description">
                {!! $landing->description ?? 'Click on a language to write and run code online instantly.' !!}
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer" style="background-color: {{ $landing->footer_color ?? '#007bff' }}">
        <div class="container">
            <p class="text-white"> {{ $settings->footer_text }}</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Filter Script -->
    <script>
        const searchInput = document.getElementById('languageSearch');
        const languageCards = document.querySelectorAll('.language-card');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();

            languageCards.forEach(card => {
                const langName = card.querySelector('h5').innerText.toLowerCase();
                if (langName.includes(query)) {
                    card.parentElement.style.display = 'block';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>
