@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">

        <div class="nk-block-head">
            <div class="nk-block-head-sub"><span>Welcome!</span>
            </div>
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">{{ Auth::user()->name }}</h2>
                    <div class="nk-block-des">
                        <p>At a glance summary of your account. Have fun!</p>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <ul class="nk-block-tools gx-3">
                        <li>
                            <a href="" class="btn btn-primary">
                                <span>Deposit</span> <em class="icon ni ni-arrow-long-right"></em>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="nk-block nk-block-lg">
            <div class="row gy-gs">
                <div class="col-md-6">
                    <div class="card-head">
                        <div class="card-title  mb-0">
                            <h5 class="title">Recent Activities</h5>
                        </div>
                        <div class="card-tools">
                            <ul class="card-tools-nav">
                                <li class="active">
                                    <a href="#">All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tranx-list card card-bordered">
                        <div class="tranx-item">
                            <div class="tranx-col">
                                <div class="tranx-info">
                                    <div class="tranx-data">
                                        <div class="tranx-label">Deposit</div>
                                        <div class="tranx-date">Nov 12, 2019 11:34 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tranx-col">
                                <div class="tranx-amount">
                                    <div class="number">53 <span class="currency currency-btc">$</span></div>
                                    <div class="number-sm">826.959 <span class="currency currency-usd">IDR</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="tranx-item">
                            <div class="tranx-col">
                                <div class="tranx-info">
                                    <div class="tranx-data">
                                        <div class="tranx-label">Deposit</div>
                                        <div class="tranx-date">Nov 12, 2019 11:34 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tranx-col">
                                <div class="tranx-amount">
                                    <div class="number">53 <span class="currency currency-btc">$</span></div>
                                    <div class="number-sm">826.959 <span class="currency currency-usd">IDR</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="tranx-item">
                            <div class="tranx-col">
                                <div class="tranx-info">
                                    <div class="tranx-data">
                                        <div class="tranx-label">Deposit</div>
                                        <div class="tranx-date">Nov 12, 2019 11:34 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tranx-col">
                                <div class="tranx-amount">
                                    <div class="number">53 <span class="currency currency-btc">$</span></div>
                                    <div class="number-sm">826.959 <span class="currency currency-usd">IDR</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="tranx-item">
                            <div class="tranx-col">
                                <div class="tranx-info">
                                    <div class="tranx-data">
                                        <div class="tranx-label">Deposit</div>
                                        <div class="tranx-date">Nov 12, 2019 11:34 PM</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tranx-col">
                                <div class="tranx-amount">
                                    <div class="number">53 <span class="currency currency-btc">$</span></div>
                                    <div class="number-sm">826.959 <span class="currency currency-usd">IDR</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-head">
                        <div class="card-title mb-0">
                            <h5 class="title">Balance Flow</h5>
                        </div>
                        <div class="card-tools">
                            <ul class="card-tools-nav">
                                <li><a href="#">This Month</a></li>
                                <li class="active"><a href="#">This Years</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="nk-wg4">
                                <div class="nk-wg4-group justify-center gy-3 gx-4">
                                    <div class="nk-wg4-item">
                                        <div class="sub-text">
                                            <div class="dot dot-lg sq" data-bg="#5ce0aa"></div> <span>Received</span>
                                        </div>
                                    </div>
                                    <div class="nk-wg4-item">
                                        <div class="sub-text">
                                            <div class="dot dot-lg sq" data-bg="#798bff"></div> <span>Send</span>
                                        </div>
                                    </div>
                                    <div class="nk-wg4-item">
                                        <div class="sub-text">
                                            <div class="dot dot-lg sq" data-bg="#f6ca3e"></div><span>Withdraw</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-ck3">
                                <canvas class="chart-account-summary" id="summaryBalance"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nk-block">
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
                                <h6 class="title">My Referral <em class="icon ni ni-info" data-bs-toggle="tooltip" data-bs-placement="right" title="Referral Informations"></em></h6>
                            </div>
                            <div class="nk-refwg-info g-3">
                                <div class="nk-refwg-sub">
                                    <div class="title">394</div>
                                    <div class="sub-text">Total Joined</div>
                                </div>
                                <div class="nk-refwg-sub">
                                    <div class="title">548.49</div>
                                    <div class="sub-text">Referral Earn</div>
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
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('account/assets/js/charts/chart-crypto.js?ver=3.0.2') }}"></script>
@endpush
