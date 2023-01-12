<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('/landing/assets/css/dashlite.css?ver=3.0.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('/landing/assets/css/theme.css?ver=3.0.2') }}">
</head>
<body class="nk-body bg-white npc-landing">
    <div class="nk-app-root">
        <div class="nk-main">
            @include('layouts.components.landing.header')

            @yield('content')

            <footer class="footer bg-lighter" id="footer">
                <div class="container">
                    <div class="row g-3 align-items-center justify-content-md-between py-4 py-md-5">
                        <div class="col-md-3">
                            <div class="footer-logo">
                                <a href="{{ route('landing') }}" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('landing/images/logo.png') }}" srcset="{{ asset('landing/images/logo2x.png') }} 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('landing/images/logo-dark.png') }}" srcset="{{ asset('landing/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9 d-flex justify-content-md-end">
                            <ul class="link-inline gx-4">
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class="hr border-light mb-0 mt-n1">
                    <div class="row g-3 align-items-center justify-content-md-between py-4">
                        <div class="col-md-8">
                            <div class="text-base">Copyright &copy; 2022 {{ config('app.name', 'Laravel') }}</div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-md-end">
                            <ul class="social">
                                <li><a href="#"><em class="icon ni ni-twitter"></em></a></li>
                                <li><a href="#"><em class="icon ni ni-facebook-f"></em></a></li>
                                <li><a href="#"><em class="icon ni ni-instagram"></em></a></li>
                                <li><a href="#"><em class="icon ni ni-pinterest"></em></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script src="{{ asset('landing/assets/js/bundle.js?ver=3.0.2') }}"></script>
    <script src="{{ asset('landing/assets/js/scripts.js?ver=3.0.2') }}"></script>

</body>
</html>
