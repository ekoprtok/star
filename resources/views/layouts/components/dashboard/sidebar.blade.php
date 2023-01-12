<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('account/images/logo.png') }}" srcset="{{ asset('account/images/logo2x.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('account/images/logo-dark.png') }}" srcset="{{ asset('account/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                <span class="nio-version">{{ config('app.name', 'Laravel') }}</span>
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-widget d-none d-xl-block">
                    <div class="user-account-info between-center">
                        <div class="user-account-main">
                            <h6 class="overline-title-alt">Available Balance</h6>
                            <div class="user-balance">2.014095 <small class="currency currency-btc">$</small></div>
                            <div class="user-balance-alt">18,934.84 <span class="currency currency-btc">$</span></div>
                        </div>
                        {{-- <a href="#" class="btn btn-white btn-icon btn-light"><em class="icon ni ni-line-chart"></em></a> --}}
                    </div>
                    <ul class="user-account-data gy-1">
                        <li>
                            <div class="user-account-label">
                                <span class="sub-text">Profits (7d)</span>
                            </div>
                            <div class="user-account-value">
                                <span class="lead-text">+ 0.0526 <span class="currency currency-btc">$</span></span>
                                <span class="text-success ms-2">3.1% <em class="icon ni ni-arrow-long-up"></em></span>
                            </div>
                        </li>
                        <li>
                            <div class="user-account-label">
                                <span class="sub-text">Deposit in orders</span>
                            </div>
                            <div class="user-account-value">
                                <span class="sub-text">0.005400 <span class="currency currency-btc">$</span></span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="nk-sidebar-widget nk-sidebar-widget-full d-xl-none pt-0">
                    <a class="nk-profile-toggle toggle-expand" data-target="sidebarProfile" href="#">
                        <div class="user-card-wrap">
                            <div class="user-card">
                                <div class="user-avatar">
                                    <span>{{ substr(Auth::user()->name,0,1) }}</span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{ Auth::user()->name }}</span>
                                    <span class="sub-text">{{ Auth::user()->email }}</span>
                                </div>
                                <div class="user-action">
                                    <em class="icon ni ni-chevron-down"></em>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="nk-profile-content toggle-expand-content" data-content="sidebarProfile">
                        <div class="user-account-info between-center">
                            <div class="user-account-main">
                                <h6 class="overline-title-alt">Available Balance</h6>
                                <div class="user-balance">2.014095 <small class="currency currency-btc">$</small></div>
                                <div class="user-balance-alt">18,934.84 <span class="currency currency-btc">$</span></div>
                            </div>
                            {{-- <a href="#" class="btn btn-icon btn-light"><em class="icon ni ni-line-chart"></em></a> --}}
                        </div>
                        <ul class="user-account-data">
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Profits (7d)</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="lead-text">+ 0.0526 <span class="currency currency-btc">$</span></span>
                                    <span class="text-success ms-2">3.1% <em class="icon ni ni-arrow-long-up"></em></span>
                                </div>
                            </li>
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Deposit in orders</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="sub-text text-base">0.005400 <span class="currency currency-btc">$</span></span>
                                </div>
                            </li>
                        </ul>
                        <ul class="link-list">
                            <li>
                                <a href="{{ route('dashboard.activity') }}">
                                    <em class="icon ni ni-activity-alt"></em>
                                    <span>Login Activity</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="link-list">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"">
                                    <em class="icon ni ni-signout"></em>
                                    <span>Sign out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nk-sidebar-menu">
                    <ul class="nk-menu">
                        <li class="nk-menu-heading">
                            <h6 class="overline-title">Menu</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                <span class="nk-menu-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                <span class="nk-menu-text">Buy Packages</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                <span class="nk-menu-text">Packages</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                <span class="nk-menu-text">Settings</span>
                            </a>
                        </li>

                        <li class="nk-menu-heading">
                            <h6 class="overline-title">Admin Panel</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
                                <span class="nk-menu-text">Package</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                <span class="nk-menu-text">Event</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nk-sidebar-footer">
                    <ul class="nk-menu nk-menu-footer">
                        <li class="nk-menu-item">
                            <a href="#" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                                <span class="nk-menu-text">Support</span>
                            </a>
                        </li>
                        <li class="nk-menu-item ms-auto">
                            <div class="dropup">
                                <a href="" class="nk-menu-link dropdown-indicator has-indicator" data-bs-toggle="dropdown" data-offset="0,10">
                                    <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                    <span class="nk-menu-text">English</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                    <ul class="language-list">
                                        <li>
                                            <a href="#" class="language-item">
                                                <img src="{{ asset('account/images/flags/english.png') }}" alt="" class="language-flag">
                                                <span class="language-name">English</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
