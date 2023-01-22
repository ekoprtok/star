@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">

        <div class="nk-block-head pb-4">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <div class="nk-block-des">
                        <p>Welcome!</p>
                    </div>
                </div>
                @if (Auth::user()->role == '0')
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li>
                                <a href="{{ route('dashboard.deposit') }}" class="btn btn-primary">
                                    <span>Add Deposit</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.withdrawal') }}" class="btn btn-primary">
                                    <span>Add Withdrawal</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.internaltransfer') }}" class="btn btn-primary">
                                    <span>Add Internal Transfer</span>
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
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-sm-3">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="{{ route('dashboard.dialy.request') }}">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Daily Challenge</h5>
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
                    <div class="col-sm-3">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="{{ route('dashboard.deposit.request') }}">
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
                    <div class="col-sm-3">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="{{ route('dashboard.withdrawal.request') }}">
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

            <div class="my-3">
                <div class="nk-block-head-xs">
                    <div class="nk-block-between-md g-2">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">Member</h5>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-sm-3">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="{{ route('dashboard.users') }}">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Total Member</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">
                                            2
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3">
                <div class="nk-block-head-xs">
                    <div class="nk-block-between-md g-2">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">Income</h5>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-sm-3">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="#">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Daily Income</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">
                                            $120
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="#">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Weekly Income</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">
                                            $130
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <a class="nk-wgw-inner" href="#">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Monthly Income</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">
                                            $250
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="my-3">
                <div class="nk-block-head-xs">
                    <div class="nk-block-between-md g-2">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">This Year</h5>
                        </div>
                    </div>
                </div>

                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="nk-wg4">
                            <div class="nk-wg4-group justify-center gy-3 gx-4">
                                <div class="nk-wg4-item">
                                    <div class="sub-text">
                                        <div class="dot dot-lg sq" data-bg="#5ce0aa"></div>
                                            <span>Deposit</span>
                                        </div>
                                    </div>
                                    <div class="nk-wg4-item">
                                        <div class="sub-text">
                                            <div class="dot dot-lg sq" data-bg="#798bff"></div>
                                                <span>Internal Transfer</span>
                                            </div>
                                        </div>
                                        <div class="nk-wg4-item">
                                            <div class="sub-text">
                                                <div class="dot dot-lg sq" data-bg="#f6ca3e"></div>
                                                <span>Withdraw</span>
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
        @endif

        @if (Auth::user()->role == '0')
        <div class="nk-block">

            <div class="card card-bordered h-100">
                <div class="card-inner">
                    <div class="nk-wg7">
                        <div class="nk-wg7-stats">
                            <div class="nk-wg7-title">Available balance in USD</div>
                            <div class="number-lg amount">$150</div>
                        </div>
                        <div class="nk-wg7-foot">
                            <span class="nk-wg7-note">Last activity at <span>{{ Helper::format_date(date('Y-m-d H:i:s'), 'l, d M Y') }}</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-4">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <h5 class="title mb-0">Your Packages</h5>
                    <a href="{{ route('dashboard.mypackages') }}" class="fw-bold">See All</a>
                </div>
                <div class="my-2">
                    <div class="row">
                        @php
                            $data = ['Regular', 'Premium', 'Advance', 'Solitaire'];
                        @endphp
                        @for ($i = 0; $i <= 2; $i++)
                            <div class="col-4">
                                <div class="card bg-light">
                                    <div class="nk-wgw sm">
                                        <div class="nk-wgw-inner">
                                            <div class="nk-wgw-name">
                                                <h5 class="nk-wgw-title title">Package {{ $data[$i] }}</h5>
                                            </div>
                                            <div class="gauge-container">
                                                <div class="gauge"></div>
                                            </div>
                                            <div class="d-flex flex-row justify-content-center">
                                                <a class="nk-wgw-balance btn btn-primary me-3" href="javascript:void()" onclick="alerts()">
                                                    Daily Blessing
                                                </a>
                                                <a class="nk-wgw-balance btn btn-primary" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#modalchallenge">
                                                    Daily Challenge
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
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

        <div class="nk-block pt-2">
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

<div class="modal fade" id="modalchallenge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Daily Challenge</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group mb-2">
                <label class="mb-1">Date</label>
                <span class="form-control">29 Jan 2023</span>
            </div>
            <div class="form-group mb-2">
                <label class="mb-1">Daily Challenge</label>
                <select class="form-select">
                    <option>Memberikan ulasan di web</option>
                    <option>Memberikan review di web</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label class="mb-1">Please upload a picture</label>
                <input type="file" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
        </div>
      </div>
    </div>
  </div>

<svg width="0" height="0" version="1.1" class="gradient-mask" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="gradientGauge">
          <stop class="color-red" offset="0%"/>
          <stop class="color-yellow" offset="17%"/>
          <stop class="color-green" offset="40%"/>
          <stop class="color-yellow" offset="87%"/>
          <stop class="color-red" offset="100%"/>
        </linearGradient>
    </defs>
  </svg>
@endsection

@push('script')

<script src="{{ asset('account/assets/js/charts/chart-crypto.js?ver=3.0.2') }}"></script>

<script>

    function alerts() {
        Swal.fire({
            title : 'Confirmation',
            text : 'Are you sure want to request?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText : 'Yes'
        })
    }

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

<script>
$(function () {

    class GaugeChart {
        constructor(element, params) {
            this._element = element;
            this._initialValue = params.initialValue;
            this._higherValue = params.higherValue;
            this._title = params.title;
            this._subtitle = params.subtitle;
        }

        _buildConfig() {
            let element = this._element;

            return {
                value: this._initialValue,
                valueIndicator: {
                    color: '#FFFFFF'
                },

                geometry: {
                    startAngle: 180,
                    endAngle: 360
                },

                scale: {
                    startValue: 0,
                    endValue: this._higherValue,
                    customTicks: [0, 25, 50, 75, 100],
                    tick: {
                        length: 5
                    },

                    label: {
                        font: {
                            color: '#87959f',
                            size: 9,
                            family: '"Open Sans", sans-serif'
                        }
                    }
                },

                title: {
                    verticalAlignment: 'bottom',
                    text: this._title,
                    font: {
                        family: '"Open Sans", sans-serif',
                        //   color: '#fff',
                        size: 0
                    },

                    subtitle: {
                        text: this._subtitle,
                        font: {
                            family: '"Open Sans", sans-serif',
                            // color: '#fff',
                            weight: 500,
                            size: 22
                        }
                    }
                },



                onInitialized: function () {
                    let currentGauge = $(element);
                    let circle = currentGauge.find('.dxg-spindle-hole').clone();
                    let border = currentGauge.find('.dxg-spindle-border').clone();

                    currentGauge.find('.dxg-title text').first().attr('y', 48);
                    currentGauge.find('.dxg-title text').last().attr('y', 28);
                    currentGauge.find('.dxg-value-indicator').append(border, circle);
                }
            };
        }

        init() {
            $(this._element).dxCircularGauge(this._buildConfig());
        }
    }


    $(document).ready(function () {

        $('.gauge').each(function (index, item) {
            let num = getRandomArbitrary(10, 99);
            let params = {
            initialValue: num,
            higherValue: 100,
            title: 'Progress' ,
            subtitle : `${parseInt(num)}%`
            };
            let gauge = new GaugeChart(item, params);
            gauge.init();
        });

    });
});

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}
</script>
@endpush
