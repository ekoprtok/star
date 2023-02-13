<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('landing/new_image/new_logo.png') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('landing/new_image/new_logo.png') }}" alt="logo-dark">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-menu">
                    <ul class="nk-menu">
                        @if (Auth::user()->role == '0')
                        <li class="nk-menu-heading">
                            <h6 class="overline-title">Menu</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                <span class="nk-menu-text">Home</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.balance') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-saving"></em></span>
                                <span class="nk-menu-text">Your Balance</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.packages') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-package"></em></span>
                                <span class="nk-menu-text">Donation</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.team.tree') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-alt"></em></span>
                                <span class="nk-menu-text">Your Team Tree</span>
                            </a>
                        </li>
                        {{-- <li class="nk-menu-item">
                            <a href="{{ route('dashboard.deposit') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-saving"></em></span>
                                <span class="nk-menu-text">Deposit</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.withdrawal') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-out"></em></span>
                                <span class="nk-menu-text">Withdrawal</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.internaltransfer') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-in"></em></span>
                                <span class="nk-menu-text">Internal Transfer</span>
                            </a>
                        </li> --}}
                        @endif

                        @if (Auth::user()->role != '0')
                        <li class="nk-menu-heading">
                            <h6 class="overline-title">Admin Panel</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                <span class="nk-menu-text">Home</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.history.transaction') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span>
                                <span class="nk-menu-text">Transactions History</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.users') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-saving"></em></span>
                                <span class="nk-menu-text">Users</span>
                            </a>
                        </li>

                        <li class="nk-menu-heading">
                            <h6 class="overline-title">Need Approval</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.dialy.request') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-check-fill-c"></em></span>
                                <span class="nk-menu-text">Daily Challenges</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.dialy.blessing') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-check-fill-c"></em></span>
                                <span class="nk-menu-text">Daily Blessing</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.package.redeem') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-check-fill-c"></em></span>
                                <span class="nk-menu-text">Package Redeem</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.social.event.request') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-check-fill-c"></em></span>
                                <span class="nk-menu-text">Social Event</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.deposit.request') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-saving"></em></span>
                                <span class="nk-menu-text">Deposit Request</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.withdrawal.request') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-out"></em></span>
                                <span class="nk-menu-text">Withdrawal Request</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('dashboard.internaltrf') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-in"></em></span>
                                <span class="nk-menu-text">Internal Transfer Request</span>
                            </a>
                        </li>

                        <li class="nk-menu-heading">
                            <h6 class="overline-title">Settings</h6>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon">
                                    <em class="icon ni ni-setting"></em>
                                </span>
                                <span class="nk-menu-text">Master Data</span>
                            </a>
                            <ul class="nk-menu-sub" style="display: none;">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.package') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Packages</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nk-menu-sub" style="display: none;">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.daily') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Daily Challenges</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nk-menu-sub" style="display: none;">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.rank') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Rank</span>
                                    </a>
                                </li>
                            </ul>
                            {{-- <ul class="nk-menu-sub" style="display: none;">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.daily.blessing') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Daily Blessing</span>
                                    </a>
                                </li>
                            </ul> --}}
                        </li>
                        @endif
                    </ul>
                </div>
                {{-- <div class="nk-sidebar-footer">
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
                </div> --}}
            </div>
        </div>
    </div>
</div>
