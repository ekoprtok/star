<header class="header has-header-main-s1 bg-dark next-overlap-3x" id="home">
    <div class="header-main header-main-s1 is-sticky is-transparent on-dark">
        <div class="container header-container">
            <div class="header-wrap">
                <div class="header-logo">
                    <a href="{{ route('landing') }}" class="logo-link">
                        <img class="logo-light logo-img" src="{{ asset('/landing/new_image/new_logo.png') }}" alt="logo">
                        <img class="logo-dark logo-img" src="{{ asset('/landing/new_image/new_logo.png') }}" alt="logo-dark">
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
                        <li class="menu-item"><a href="{{ route('landing.about') }}" class="menu-link nav-link">About Us</a></li>
                    </ul>
                    <ul class="menu-btns">
                        <li>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg btn-round">Join</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    @if (Route::is('landing'))
    <div class="header-content my-auto py-6 is-dark">
        <div class="container mt-n4 mt-lg-0">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-9 col-md-10 text-center">
                    <div class="text-block is-compact py-3">
                        <h3 class="title">Helping Hand Community Club</h3>
                        <h1>Spread kindness to the world and bring prosperity to all.</h1>
                        <ul class="header-action btns-inline">
                            <li><a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg btn-round"><span>Join Us!</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-image bg-overlay after-bg-dark after-opacity-95">
        <img src="{{ asset('/landing/new_image/hands-joined-min.jpg') }}" alt="">
    </div>
    @endif
</header>
