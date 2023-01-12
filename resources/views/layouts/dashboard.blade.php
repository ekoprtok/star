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
    @stack('style')
    <style>
        thead, tbody, tfoot, tr, td, th {
            vertical-align: middle;
        }
    </style>
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
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="{{ asset('account/assets/js/bundle.js?ver=3.0.2') }}"></script>
    <script src="{{ asset('account/assets/js/scripts.js?ver=3.0.2') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'Authorization' : 'Bearer {{ Auth::user()->web_token }}'
            }
        });
    </script>
    @stack('script')
</body>
</html>
