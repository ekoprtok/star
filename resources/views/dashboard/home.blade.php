@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">

        <div class="nk-block-head">
            <div class="nk-block-head-sub">
                <span>Welcome!</span>
            </div>
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">{{ Auth::user()->name }}</h2>
                    <div class="nk-block-des">
                        <p>At a glance summary of your account. Have fun!</p>
                    </div>
                </div>
                @if (Auth::user()->role == '0')
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li>
                                <a href="{{ route('dashboard.deposit') }}" class="btn btn-primary">
                                    <span>Deposit</span> <em class="icon ni ni-arrow-long-right"></em>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        @if (Auth::user()->role != '0')
        <div class="nk-block">
            <div class="">
                <div class="nk-block-head-xs">
                    <div class="nk-block-between-md g-2">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">Unapprove Status</h5>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="/demo5/crypto/wallets.html" class="link link-primary">See All</a>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-sm-4">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="/demo5/crypto/wallet-bitcoin.html">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Dialy Challenge</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">
                                            10
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="/demo5/crypto/wallet-bitcoin.html">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Deposit Wallet</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">
                                            4
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="/demo5/crypto/wallet-bitcoin.html">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Withdrawal Wallet</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">
                                            1
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (Auth::user()->role == '0')
        <div class="nk-block">

            <div class="d-flex flex-row mb-4">
                <div class="card card-bordered text-light is-dark h-100 w-25">
                    <div class="card-inner">
                        <div class="nk-wg7">
                            <div class="nk-wg7-stats">
                                <div class="nk-wg7-title">Available balance in USD</div>
                                <div class="number-lg amount">179,8</div>
                            </div>
                            <div class="nk-wg7-foot">
                                <span class="nk-wg7-note">Last activity at <span>19 Nov, 2019</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-4 w-75">
                    <div class="nk-block-head-xs">
                        <div class="nk-block-between-md g-2">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title title">Donation Packages</h5>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="/demo5/crypto/wallets.html" class="link link-primary">See All</a>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <div class="card bg-light">
                                <div class="nk-wgw sm">
                                    <a class="nk-wgw-inner" href="/demo5/crypto/wallet-bitcoin.html">
                                        <div class="nk-wgw-name">
                                            <h5 class="nk-wgw-title title">Package Regular</h5>
                                        </div>
                                        <a class="nk-wgw-balance btn btn-primary mx-3 mb-2">
                                            Dialy Challenge
                                        </a>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-light">
                                <div class="nk-wgw sm">
                                    <a class="nk-wgw-inner" href="/demo5/crypto/wallet-bitcoin.html">
                                        <div class="nk-wgw-name">
                                            <h5 class="nk-wgw-title title">Package Regular</h5>
                                        </div>
                                        <a class="nk-wgw-balance btn btn-primary mx-3 mb-2">
                                            Dialy Challenge
                                        </a>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-light">
                                <div class="nk-wgw sm">
                                    <a class="nk-wgw-inner" href="/demo5/crypto/wallet-bitcoin.html">
                                        <div class="nk-wgw-name">
                                            <h5 class="nk-wgw-title title">Package Regular</h5>
                                        </div>
                                        <a class="nk-wgw-balance btn btn-primary mx-3 mb-2">
                                            Dialy Challenge
                                        </a>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-bordered">
                <div class="nk-refwg">
                    <div class="nk-refwg-invite card-inner">
                        <div class="nk-refwg-head g-3">
                            <div class="nk-refwg-title">
                                <h5 class="title">Refer Us & Earn</h5>
                                <div class="title-sub">Use the bellow link to invite your friends.</div>
                            </div>
                            <div class="nk-refwg-action">
                                <a href="#" class="btn btn-primary">Invite</a>
                            </div>
                        </div>
                        <div class="nk-refwg-url">
                            <div class="form-control-wrap">
                                <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy Link</span></div>
                                <div class="form-icon">
                                    <em class="icon ni ni-link-alt"></em>
                                </div>
                                <input type="text" class="form-control copy-text" id="refUrl" value="{{ route('dashboard') }}?ref=4945KD48">
                            </div>
                        </div>
                    </div>
                    <div class="nk-refwg-stats card-inner bg-lighter">
                        <div class="nk-refwg-group g-3">
                            <div class="nk-refwg-name">
                                <h6 class="title">Team Information <em class="icon ni ni-info" data-bs-toggle="tooltip" data-bs-placement="right" title="Referral Informations"></em></h6>
                            </div>
                            <div class="nk-refwg-info g-3">
                                <div class="nk-refwg-sub">
                                    <div class="title">3/$1000</div>
                                    <div class="sub-text">Direction Donation</div>
                                </div>
                                <div class="nk-refwg-sub">
                                    <div class="title">30/$12000</div>
                                    <div class="sub-text">Team Donation</div>
                                </div>
                            </div>
                            <div class="nk-refwg-more dropdown mt-n1 me-n1">
                                <a href="#" class="btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                    <ul class="link-list-plain sm">
                                        <li><a href="#">7 days</a></li>
                                        <li><a href="#">15 Days</a></li>
                                        <li><a href="#">30 Days</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="nk-refwg-ck">
                            <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nk-block nk-block-lg">
            <h5 class="title">Request Status</h5>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Date Of Submitted</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>File</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <div class="align-center flex-wrap flex-md-nowrap g-4">
                        <div class="nk-block-image w-120px flex-shrink-0">
                            <img src="{{ asset('landing/images/home_icon_6.svg') }}">
                        </div>
                        <div class="nk-block-content">
                            <div class="nk-block-content-head px-lg-4">
                                <h5>We’re here to help you!</h5>
                                <p class="text-soft">Ask a question or file a support ticket, manage request, report an issues. Our team support team will get back to you by email.</p>
                            </div>
                        </div>
                        <div class="nk-block-content flex-shrink-0">
                            <a href="#" class="btn btn-lg btn-outline-primary">Get Support Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('account/assets/js/charts/chart-crypto.js?ver=3.0.2') }}"></script>

<script>
    NioApp.DataTable('.datatable', {
        processing: true,
        serverSide: true,
        ajax : {
            url  : '{{ route('request.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'date' },
            { data: 'type' },
            { data: 'desc' },
            { data: 'file' },
            { data: 'status' }
        ],
        ordering : false
    });
</script>
@endpush
