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
    <style>
        .logo-img {
            max-height: 100px;
        }
    </style>
</head>

<body class="nk-body bg-white npc-general pg-error">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-xs mx-auto">
                        <div class="nk-block-content nk-error-ld text-center">
                            <img class="logo-img mb-4" src="{{ asset('/landing/new_image/new_logo.png') }}" alt="logo">
                            <h3 class="nk-error-title">Under Maintenance</h3>
                            <p class="nk-error-text">We are currently under maintenance, we will be back soon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>
