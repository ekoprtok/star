<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'H2C') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/landing/new_image/fav.png') }}">
    <link rel="stylesheet" href="{{ asset('landing/assets/css/dashlite.css?ver=3.0.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('landing/assets/css/theme.css?ver=3.0.2') }}">
    @stack('style')
    @include('layouts.components.dashboard.style')
</head>
<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                    <a href="{{ route('landing') }}" class="logo-link">
                                        <img class="logo-light logo-img" src="{{ asset('landing/new_image/new_logo.png') }}" alt="logo">
                                        <img class="logo-dark logo-img" src="{{ asset('landing/new_image/new_logo.png') }}" alt="logo-dark">
                                    </a>
                                </div>
                                @yield('content')
                            </div>

                            <div class="nk-block nk-auth-footer">
                                <div class="nk-block-between">
                                    <ul class="nav nav-sm">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('landing.help') }}">Help</a>
                                        </li>
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link text-base" data-bs-toggle="dropdown" data-offset="0,10"><small>English</small></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset('landing/images/flags/english.png') }}" alt="" class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset('landing/images/flags/spanish.png') }}" alt="" class="language-flag">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-3">
                                    <p>&copy; 2022 {{ config('app.name', 'Laravel') }}. All Rights Reserved.</p>
                                </div>
                            </div>
                        </div>
                        @include('layouts.components.auth.sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="{{ asset('landing/assets/js/bundle.js?ver=3.0.2') }}"></script>
    <script src="{{ asset('landing/assets/js/scripts.js?ver=3.0.2') }}"></script>
    @stack('script')
</body>
</html>
