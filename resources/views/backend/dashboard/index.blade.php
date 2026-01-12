@extends('backend.master')


@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <h4>{{ __('messages.dashboard') }}</h4>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 h-100">
                            <div class="d-flex flex-column justify-content-between">
                                <div>
                                    <h4>{{ __('messages.hi') }}, {{ auth()->user()->name }}</h4>
                                    @php
                                        $hour = now()->format('H');
                                        if ($hour < 12) {
                                            $greet = __('messages.good_morning');
                                        } elseif ($hour < 18) {
                                            $greet = __('messages.good_afternoon');
                                        } else {
                                            $greet = __('messages.good_evening');
                                        }
                                    @endphp

                                    <h6 class="text-muted fw-500 pt-2">{{ $greet }}</h6>

                                    <p class="pb-3">{{ __('messages.today_updates') }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('settings') }}" class="btn btn-primary">
                                        <i class="bi bi-gear me-1"></i> {{ __('messages.go_to_settings') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <img class="dashobard-image" src="{{ asset('backend/assets/img/dashobard.png') }}"
                                alt="Dashobard">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow card-dashboard-right">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-icon purple">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <div class="d-right-text">
                                    <h4>{{ __('Total Languages') }}</h4>
                                    <h3>{{ $languages->count() }}</h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow card-dashboard-right">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-icon blue">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <div class="d-right-text">
                                    <h4>{{ __('Active Languages') }}</h4>
                                    <h3>{{ $languages->where('is_active', true)->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow card-dashboard-right">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-icon green">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <div class="d-right-text">
                                    <h4>{{ __('Total Languages') }}</h4>
                                    <h3>{{ $languages->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow card-dashboard-right">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-icon orange">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <div class="d-right-text">
                                    <h4>{{ __('Total Languages') }}</h4>
                                    <h3>{{ $languages->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

