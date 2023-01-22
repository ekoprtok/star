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
        .gauge-container {
            /* padding: 20px;
            margin-top: 80px; */
            display: flex;
            justify-content: space-around;
        }
        .gauge {
        height: 220px;
        width: 300px;
        }
        .gauge .dxg-range.dxg-background-range {
        fill: url(#gradientGauge);
        }
        .gauge .dxg-line {
        transform: scaleX(1.04) scaleY(1.03) translate(-4px, -4px);
        }
        .gauge .dxg-line path:first-child,
        .gauge .dxg-line path:last-child {
        display: none;
        }
        .gauge .dxg-line path:nth-child(2),
        .gauge .dxg-line path:nth-child(6) {
        stroke: #ed811c;
        }
        .gauge .dxg-line path:nth-child(3),
        .gauge .dxg-line path:nth-child(5) {
        stroke: #a7db29;
        }
        .gauge .dxg-line path:nth-child(4) {
        stroke: #25cd6b;
        }
        .gauge .dxg-elements text:first-child {
        transform: translate(19px, 13px);
        }
        .gauge .dxg-elements text:last-child {
        transform: translate(-27px, 14px);
        }
        .gauge .dxg-value-indicator path {
        transform: scale(1.2) translate(0, -5px);
        transform-origin: center center;
        }
        .gauge .dxg-value-indicator .dxg-title {
        text-transform: uppercase;
        }
        .gauge .dxg-value-indicator .dxg-title text:first-child {
        transform: translateY(5px);
        }
        .gauge .dxg-value-indicator .dxg-spindle-border:nth-child(4),
        .gauge .dxg-value-indicator .dxg-spindle-hole:nth-child(5) {
        transform: translate(0, -109px);
        }
        .gauge .dxg-value-indicator .dxg-spindle-hole {
        fill: #26323a;
        }
        .color-red {
        stop-color: #e23131;
        }

        .color-yellow {
        stop-color: #fbe500;
        }

        .color-green {
        stop-color: #25cd6b;
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
    <script src="https://cdn3.devexpress.com/jslib/17.1.6/js/dx.all.js"></script>
    <script>
        function showResponseHeader(response) {
            if (response.status == 422) {
                let _errors = JSON.parse(response.responseText);
                let errors = _errors.errors;
                let keys   = Object.keys(errors);
                keys.map((item, index) => {
                    $('.'+item+'_err').html(errors[item].toString( ));
                });
            }else if (response.status != 200) {
                let _errors = JSON.parse(response.responseText);
                toastr.clear();
                NioApp.Toast(_errors.message, 'error', {
                    position: 'top-right'
                });
            }
        }

        function setEditProps(response) {
            let keys = Object.keys(response);
            keys.map((item, index) => {
                if (item == 'id') {

                }else {
                    $(`input[name="${item}"]`).val(response[item]);
                    $(`textarea[name="${item}"]`).val(response[item]);
                }
            })
        }
    </script>
    @stack('script')
</body>
</html>
