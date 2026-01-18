<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code - Home</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- Lib -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/lib/fontawesome/css/all.css') }}">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
</head>

<body>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation">
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

    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="hero-content text-center">
                        <div class="hero-tag-content">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.62467 10.3333C6.56515 10.1026 6.44489 9.89206 6.27641 9.72358C6.10793 9.5551 5.89738 9.43485 5.66667 9.37533L1.57667 8.32066C1.50689 8.30085 1.44547 8.25883 1.40174 8.20096C1.35801 8.14309 1.33435 8.07253 1.33435 7.99999C1.33435 7.92746 1.35801 7.8569 1.40174 7.79903C1.44547 7.74116 1.50689 7.69913 1.57667 7.67933L5.66667 6.62399C5.8973 6.56453 6.1078 6.44438 6.27627 6.27602C6.44474 6.10766 6.56504 5.89725 6.62467 5.66666L7.67933 1.57666C7.69894 1.50661 7.74092 1.44489 7.79888 1.40092C7.85684 1.35696 7.92759 1.33316 8.00033 1.33316C8.07308 1.33316 8.14383 1.35696 8.20179 1.40092C8.25974 1.44489 8.30173 1.50661 8.32133 1.57666L9.37533 5.66666C9.43485 5.89737 9.55511 6.10792 9.72359 6.27641C9.89207 6.44489 10.1026 6.56514 10.3333 6.62466L14.4233 7.67866C14.4937 7.69806 14.5557 7.74 14.5999 7.79804C14.6441 7.85609 14.668 7.92703 14.668 7.99999C14.668 8.07295 14.6441 8.1439 14.5999 8.20194C14.5557 8.25999 14.4937 8.30193 14.4233 8.32133L10.3333 9.37533C10.1026 9.43485 9.89207 9.5551 9.72359 9.72358C9.55511 9.89206 9.43485 10.1026 9.37533 10.3333L8.32067 14.4233C8.30106 14.4934 8.25908 14.5551 8.20112 14.5991C8.14316 14.643 8.07241 14.6668 7.99967 14.6668C7.92692 14.6668 7.85617 14.643 7.79821 14.5991C7.74026 14.5551 7.69827 14.4934 7.67867 14.4233L6.62467 10.3333Z"
                                    stroke="#7C3BED" stroke-width="1.33333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M13.3333 2V4.66667" stroke="#7C3BED" stroke-width="1.33333"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.6667 3.33333H12" stroke="#7C3BED" stroke-width="1.33333"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2.66669 11.3333V12.6667" stroke="#7C3BED" stroke-width="1.33333"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.33333 12H2" stroke="#7C3BED" stroke-width="1.33333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <p>{{ $landing['header_sub_title'] }}</p>
                        </div>


                        @php
                            function splitString($str)
                            {
                                $words = explode(' ', $str);
                                $mid = floor(count($words) / 2);
                                $firstPart = implode(' ', array_slice($words, 0, $mid));
                                $secondPart = implode(' ', array_slice($words, $mid));
                                return [$firstPart, $secondPart];
                            }

                            [$first, $second] = splitString($landing['header_title']);
                        @endphp


                        <h1>{{ $first }} <span class="gradient-text">{{ $second }}</span></h1>
                        <h4>{{ $landing['header_short_description'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="propular-lang">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="search-language">
                        <div class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z"
                                    stroke="#6B7280" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M17.5 17.5L13.9167 13.9167" stroke="#6B7280" stroke-width="1.66667"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <input type="text" class="search-box form-control"
                            placeholder="Search programming language...">
                    </div>

                </div>
            </div>




            <div class="row">
                <div class="col-md-12">
                    <div class="heading-text">
                        <h3>{{ $landing['lang_header'] }}</h3>
                        <p>{{ $landing['lang_description'] }}</p>
                    </div>
                </div>
            </div>


            <div class="row g-4 justify-content-center" id="language-list">
                @forelse ($languages as $language)
                    <div class="col-md-2 language-item">
                        <a href="{{ route('frontend.editor', $language->slug) }}" class="popular-lang-item">
                            <div class="icon">
                                <img src="{{ $language->icon_show }}" alt="{{ $language->name }}">
                            </div>
                            <p>{{ $language->display_name }}</p>
                        </a>
                    </div>
                @empty
                    <div class="col-md-6 mx-auto">
                        <div class="alert alert-info d-flex align-items-center justify-content-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div>
                                No language found.
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>


    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @php
                        [$first, $second] = splitString($landing['about_header']);
                    @endphp
                    <div class="heading-text">
                        <h3>{{ $first }} <span class="gradient-text">{{ $second }}</span></h3>
                        <p>{{ $landing['about_short_description'] }}</p>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="about-text">
                        {!! $landing['about_description'] !!}
                    </div>


                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="about-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_1']) }}"
                                        alt="{{ $landing['about_card_header_1'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_1'] }}</h4>
                                <p>{{ $landing['about_card_description_1'] }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="about-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_2']) }}"
                                        alt="{{ $landing['about_card_header_2'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_2'] }}</h4>
                                <p>{{ $landing['about_card_description_2'] }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="about-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_3']) }}"
                                        alt="{{ $landing['about_card_header_3'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_3'] }}</h4>
                                <p>{{ $landing['about_card_description_3'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="why-choose-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-text">
                        <h3>Why Use Our Online Code Compiler?</h3>
                        <p>Everything you need to write, test, and run code — right in your browser.</p>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-9 mx-auto">
                    <div class="row  g-4">
                        <div class="col-md-4">
                            <div class="choose-us-item">
                                <div class="icon-tag">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.99999 13.9999C3.81076 14.0006 3.62522 13.9475 3.46495 13.8469C3.30467 13.7463 3.17623 13.6023 3.09454 13.4316C3.01286 13.2609 2.98129 13.0705 3.00349 12.8826C3.0257 12.6946 3.10077 12.5169 3.21999 12.3699L13.12 2.16992C13.1943 2.0842 13.2955 2.02628 13.407 2.00565C13.5185 1.98503 13.6337 2.00293 13.7337 2.05642C13.8337 2.10991 13.9126 2.19582 13.9573 2.30003C14.0021 2.40424 14.0101 2.52057 13.98 2.62992L12.06 8.64992C12.0034 8.80144 11.9844 8.96444 12.0046 9.12493C12.0248 9.28541 12.0837 9.4386 12.1761 9.57135C12.2685 9.70409 12.3918 9.81243 12.5353 9.88708C12.6788 9.96172 12.8382 10.0004 13 9.99992H20C20.1892 9.99927 20.3748 10.0523 20.535 10.1529C20.6953 10.2535 20.8238 10.3976 20.9054 10.5683C20.9871 10.739 21.0187 10.9293 20.9965 11.1173C20.9743 11.3052 20.8992 11.483 20.78 11.6299L10.88 21.8299C10.8057 21.9156 10.7045 21.9736 10.593 21.9942C10.4815 22.0148 10.3663 21.9969 10.2663 21.9434C10.1663 21.8899 10.0874 21.804 10.0427 21.6998C9.99791 21.5956 9.98991 21.4793 10.02 21.3699L11.94 15.3499C11.9966 15.1984 12.0156 15.0354 11.9954 14.8749C11.9752 14.7144 11.9163 14.5612 11.8239 14.4285C11.7315 14.2957 11.6082 14.1874 11.4647 14.1128C11.3212 14.0381 11.1617 13.9994 11 13.9999H3.99999Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h4>Instant Setup</h4>
                                <p>Run your code in milliseconds with our
                                    optimized cloud infrastructure.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="choose-us-item">
                                <div class="icon-tag">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 2C9.43223 4.69615 8 8.27674 8 12C8 15.7233 9.43223 19.3038 12 22C14.5678 19.3038 16 15.7233 16 12C16 8.27674 14.5678 4.69615 12 2Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M2 12H22" stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h4>Instant Setup</h4>
                                <p>Run your code in milliseconds with our
                                    optimized cloud infrastructure.</p>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="choose-us-item">
                                <div class="icon-tag">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 18L22 12L16 6" stroke="#7C3BED" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8 6L2 12L8 18" stroke="#7C3BED" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h4>Instant Setup</h4>
                                <p>Run your code in milliseconds with our
                                    optimized cloud infrastructure.</p>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="choose-us-item">
                                <div class="icon-tag">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H6C4.93913 15 3.92172 15.4214 3.17157 16.1716C2.42143 16.9217 2 17.9391 2 19V21"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M22 20.9999V18.9999C21.9993 18.1136 21.7044 17.2527 21.1614 16.5522C20.6184 15.8517 19.8581 15.3515 19 15.1299"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16 3.12988C16.8604 3.35018 17.623 3.85058 18.1676 4.55219C18.7122 5.2538 19.0078 6.11671 19.0078 7.00488C19.0078 7.89305 18.7122 8.75596 18.1676 9.45757C17.623 10.1592 16.8604 10.6596 16 10.8799"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h4>Instant Setup</h4>
                                <p>Run your code in milliseconds with our
                                    optimized cloud infrastructure.</p>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="choose-us-item">
                                <div class="icon-tag">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 3H4C2.89543 3 2 3.89543 2 5V15C2 16.1046 2.89543 17 4 17H20C21.1046 17 22 16.1046 22 15V5C22 3.89543 21.1046 3 20 3Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M8 21H16" stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 17V21" stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h4>Instant Setup</h4>
                                <p>Run your code in milliseconds with our
                                    optimized cloud infrastructure.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="choose-us-item">
                                <div class="icon-tag">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14Z"
                                            stroke="#7C3BED" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h4>Instant Setup</h4>
                                <p>Run your code in milliseconds with our
                                    optimized cloud infrastructure.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <p>&copy; 2025 Online Code Compiler — Developed by Softvence</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Lib -->
    <script src="{{ asset('frontend/assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/vivus-master/dist/vivus.min.js') }}"></script>

    <!-- Custom -->
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>



</body>

</html>


{{-- <!DOCTYPE html>
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

</html> --}}
