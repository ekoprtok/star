<div class="nk-wrap ">
    <!-- main header @s -->
    <div class="nk-header nk-header-fluid nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ms-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                        <em class="icon ni ni-menu"></em>
                    </a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="{{ route('dashboard') }}" class="logo-link">
                        <img class="logo-light logo-img" src="{{ asset('account/images/logo.png') }}" srcset="{{ asset('account/images/logo2x.png') }} 2x" alt="logo">
                        <img class="logo-dark logo-img" src="{{ asset('account/images/logo-dark.png') }}" srcset="{{ asset('account/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                        <span class="nio-version">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
                {{-- <div class="nk-header-news d-none d-xl-block">
                    <div class="nk-news-list">
                        <a class="nk-news-item" href="#">
                            <div class="nk-news-icon">
                                <em class="icon ni ni-card-view"></em>
                            </div>
                            <div class="nk-news-text">
                                <p>Do you know the latest update of 2022? <span> A overview of our is now available on YouTube</span></p>
                                <em class="icon ni ni-external"></em>
                            </div>
                        </a>
                    </div>
                </div> --}}
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                        {{-- <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                            <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                <div class="quick-icon border border-light">
                                    <img class="icon" src="{{ asset('account/images/flags/english-sq.png') }}" alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                                <ul class="language-list">
                                    <li>
                                        <a href="#" class="language-item">
                                            <img src="{{ asset('account/images/flags/english.png') }}" alt="" class="language-flag">
                                            <span class="language-name">English</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info d-none d-md-block">
                                        {{-- <div class="user-status user-status-unverified">Unverified</div> --}}
                                        <div class="user-name dropdown-indicator">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <span>{{ substr(Auth::user()->name,0,1) }}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ Auth::user()->name }}</span>
                                            <span class="sub-text">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li>
                                            <a href="{{ route('dashboard') }}">
                                                <em class="icon ni ni-lock-alt"></em>
                                                <span>Change Password</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}">
                                                <em class="icon ni ni-activity-alt"></em>
                                                <span>Activity Log</span>
                                            </a>
                                        </li>
                                        {{-- <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li> --}}
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
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
                        </li>
                        <li class="dropdown notification-dropdown me-n1">
                            <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                <div class="icon-status icon-status-info icon-notif">
                                    <i class="icon ni ni-bell"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                                <div class="dropdown-head">
                                    <span class="sub-title nk-dropdown-title">Notifications</span>
                                    <a href="#">Mark All as Read</a>
                                </div>
                                <div class="dropdown-body">
                                    <div class="nk-notification notif-container">
                                        <div class="text-center py-2 text-muted">You haven't any notification</div>
                                    </div>
                                </div>
                                <div class="dropdown-foot center">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
