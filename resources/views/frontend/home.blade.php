@extends('frontend.master')

@section('title', 'Home')

@section('content')
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
                                <path d="M13.3333 2V4.66667" stroke="#7C3BED" stroke-width="1.33333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M14.6667 3.33333H12" stroke="#7C3BED" stroke-width="1.33333" stroke-linecap="round"
                                    stroke-linejoin="round" />
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

                        <input type="text" class="search-box" placeholder="Search programming language...">
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


            <div class="row g-3 g-md-4 justify-content-center" id="language-list">
                @forelse ($languages as $language)
                    <div class="col-6 col-md-3 col-lg-2 language-item">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                                role="img" aria-label="Warning:">
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
                <div class="col-lg-8 mx-auto">
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
                        <h3>{{ $landing['about_header_2'] }}</h3>
                        <p>{{ $landing['about_short_description_2'] }}</p>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <div class="row  g-4">
                        <div class="col-12 col-md-4">
                            <div class="choose-us-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_4']) }}"
                                        alt="{{ $landing['about_card_header_4'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_4'] }}</h4>
                                <p>{{ $landing['about_card_description_4'] }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="choose-us-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_5']) }}"
                                        alt="{{ $landing['about_card_header_5'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_5'] }}</h4>
                                <p>{{ $landing['about_card_description_5'] }}</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="choose-us-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_6']) }}"
                                        alt="{{ $landing['about_card_header_6'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_6'] }}</h4>
                                <p>{{ $landing['about_card_description_6'] }}</p>
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="choose-us-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_7']) }}"
                                        alt="{{ $landing['about_card_header_7'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_7'] }}</h4>
                                <p>{{ $landing['about_card_description_7'] }}</p>
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="choose-us-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_8']) }}"
                                        alt="{{ $landing['about_card_header_8'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_8'] }}</h4>
                                <p>{{ $landing['about_card_description_8'] }}</p>
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <div class="choose-us-item h-100">
                                <div class="icon-tag">
                                    <img src="{{ asset($landing['about_card_icon_9']) }}"
                                        alt="{{ $landing['about_card_header_9'] }}">
                                </div>
                                <h4>{{ $landing['about_card_header_9'] }}</h4>
                                <p>{{ $landing['about_card_description_9'] }}</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
