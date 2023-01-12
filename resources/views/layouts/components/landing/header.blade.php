<header class="{{ (Route::is('landing') ? 'header has-header-main-s1 bg-lighter' : '') }}" id="home">
    <div class="header-main header-main-s1 is-sticky is-transparent">
        <div class="container header-container">
            <div class="header-wrap">
                <div class="header-logo">
                    <a href="{{ route('landing') }}" class="logo-link">
                        <img class="logo-light logo-img" src="{{ asset('landing/images/logo.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                        <img class="logo-dark logo-img" src="{{ asset('landing/images/logo-dark.png') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div>
                <div class="header-toggle">
                    <button class="menu-toggler" data-target="mainNav">
                        <em class="menu-on icon ni ni-menu"></em>
                        <em class="menu-off icon ni ni-cross"></em>
                    </button>
                </div>
                <nav class="header-menu" data-content="mainNav">
                    <ul class="menu-list ms-lg-auto">
                        <li class="menu-item"><a href="{{ route('landing') }}" class="menu-link nav-link">Home</a></li>
                        <li class="menu-item"><a href="{{ route('landing.news') }}" class="menu-link nav-link">News</a></li>
                        <li class="menu-item"><a href="{{ route('landing.help') }}" class="menu-link nav-link">Help</a></li>
                        <li class="menu-item"><a href="{{ route('landing.contact') }}" class="menu-link nav-link">Contact Us</a></li>
                    </ul>
                    <ul class="menu-btns">
                        <li>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Login</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    @if (Route::is('landing'))
        @include('layouts.components.landing.banner')
    @endif
</header>
