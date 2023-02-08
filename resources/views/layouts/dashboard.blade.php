<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="bearer-token" content="{{ auth()->user()->remember_token }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('account/assets/css/dashlite.css?ver=3.0.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('account/assets/css/theme.css?ver=3.0.2') }}">
    <link rel="stylesheet" href="{{ asset('account/assets/css/libs/bootstrap-icons.css?ver=3.1.2') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('/landing/new_image/fav.png') }}">
    @stack('style')
    @include('layouts.components.dashboard.style')
</head>

<body class="nk-body npc-crypto bg-white has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main">
            @include('layouts.components.dashboard.sidebar')
            @include('layouts.components.dashboard.subheader')
            <div class="nk-content nk-content-fluid">
                @yield('content')
            </div>
            @include('layouts.components.dashboard.footer')
        </div>
    </div>

    <svg width="0" height="0" version="1.1" class="gradient-mask" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="gradientGauge">
                <stop class="color-red" offset="0%" />
                <stop class="color-yellow" offset="17%" />
                <stop class="color-green" offset="40%" />
                <stop class="color-yellow" offset="87%" />
                <stop class="color-red" offset="100%" />
            </linearGradient>
        </defs>
    </svg>

    @include('layouts.components.dashboard.script')
    @stack('script')
</body>

</html>
