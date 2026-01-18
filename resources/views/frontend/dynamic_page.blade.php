@extends('frontend.master')

@section('title', $page->page_title)

@section('content')

    <div class="container">
        <section class="py-5 mt-5">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h1 class="text-center">{{ $page->page_title }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 line-height-28px text-justify">
                    {!! $page->page_content !!}
                </div>
            </div>
        </section>
    </div>

@endsection
