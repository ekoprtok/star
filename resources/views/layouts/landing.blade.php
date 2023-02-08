<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'H2C') }}</title>
    <meta name="author" content="{{ config('app.name', 'Laravel') }}">
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="{{ asset('/landing/new_image/fav.png') }}">
    <link rel="stylesheet" href="{{ asset('/landing/assets/css/dashlite.css?ver=3.0.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('/landing/assets/css/theme.css?ver=3.0.2') }}">
    <link rel="stylesheet" href="{{ asset('account/assets/css/libs/bootstrap-icons.css?ver=3.1.2') }}">
    @include('layouts.components.dashboard.style')
</head>

<body class="nk-body bg-white npc-landing ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('layouts.components.landing.header')

            @yield('content')

            <footer class="footer bg-dark is-dark">
                <div class="container">
                    <div class="row justify-content-between py-4 py-md-6">
                        <div class="col-lg-4 col-md-6">
                            <div class="widget widget-about">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('/landing/new_image/new_logo.png') }}" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('/landing/new_image/new_logo.png') }}" alt="logo-dark">
                                </a>
                                <p>Spread kindness to the world and bring prosperity to all.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">

                        </div>
                    </div>
                    <hr class="hr border-light mb-0 mt-n1">
                    <div class="row g-3 align-items-center justify-content-md-between py-4">
                        <div class="col-md-8">
                            <div class="text-base">Copyright &copy; 2022 {{ config('app.name', 'Laravel') }}</div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-md-end">

                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('landing/assets/js/bundle.js?ver=3.0.2') }}"></script>
    <script src="{{ asset('landing/assets/js/scripts.js?ver=3.0.2') }}"></script>
    @stack('script')
</body>

</html>
