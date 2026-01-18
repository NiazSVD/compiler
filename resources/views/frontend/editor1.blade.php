@extends('frontend.master')

@section('title', 'Editor1 Page')

@section('styles')
    <style>
        .navbar {
            background: rgba(243, 244, 246, 1);
        }
    </style>
@endsection

@section('content')
    <div class="vh-100" style="padding-top: 100px;">
        <div class="sidenav">
            @include('frontend.layouts.sidenav')
        </div>

        <div class="editor-section">
            sdafsdf
        </div>
    </div>
@endsection
