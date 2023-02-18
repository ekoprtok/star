@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
        <div class="nk-content-body">

            <div class="nk-block-head pb-4">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <div class="nk-block-des">
                            @if (Auth::user()->role == '0')
                                <p>Welcome! <span class="username"></span> | <span class="rank"></span></p>
                            @endif

                            @if (Auth::user()->role != '0')
                                <p>Welcome!</p>
                            @endif
                        </div>
                    </div>
                    @if (Auth::user()->role == '0')
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools gx-3">
                                <li>
                                    <a href="{{ route('dashboard.social.event') }}" class="btn btn-primary">
                                        <span>Add Social Event</span>
                                    </a>
                                </li>
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
                                                <div class="daily_challenge fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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
                                                <div class="deposit fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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
                                                <div class="withdraw fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card bg-light">
                                    <div class="nk-wgw sm">
                                        <a class="nk-wgw-inner" href="{{ route('dashboard.internaltrf') }}">
                                            <div class="nk-wgw-name">
                                                <h5 class="nk-wgw-title title">Internal Transfer</h5>
                                            </div>
                                            <div class="nk-wgw-balance">
                                                <div class="internal_transfer fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card bg-light">
                                    <div class="nk-wgw sm">
                                        <a class="nk-wgw-inner" href="{{ route('dashboard.package.redeem') }}">
                                            <div class="nk-wgw-name">
                                                <h5 class="nk-wgw-title title">Package Redeem</h5>
                                            </div>
                                            <div class="nk-wgw-balance">
                                                <div class="redeem fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card bg-light">
                                    <div class="nk-wgw sm">
                                        <a class="nk-wgw-inner" href="{{ route('dashboard.social.event.request') }}">
                                            <div class="nk-wgw-name">
                                                <h5 class="nk-wgw-title title">Social Event</h5>
                                            </div>
                                            <div class="nk-wgw-balance">
                                                <div class="social_event fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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
                                                <div class="member fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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
                                                <h5 class="nk-wgw-title title">Current Balance</h5>
                                            </div>
                                            <div class="nk-wgw-balance">
                                                <div class="current_balance fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-sm-3">
                                <div class="card bg-light">
                                    <div class="nk-wgw sm">
                                        <a class="nk-wgw-inner" href="#">
                                            <div class="nk-wgw-name">
                                                <h5 class="nk-wgw-title title">Daily Income</h5>
                                            </div>
                                            <div class="nk-wgw-balance">
                                                <div class="daily_income fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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
                                                <div class="weekly_income fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
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
                                                <div class="monthly_income fw-500 fs-5">
                                                    <div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>

                    {{-- <div class="my-3">
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
                    </div> --}}

                </div>
            @endif

            @if (Auth::user()->role == '0')
                <div class="nk-block">

                    <div class="card card-bordered h-100">
                        <div class="card-inner">
                            <div class="nk-wg7">
                                <div class="nk-wg7-stats">
                                    <div class="nk-wg7-title">Available balance in USD</div>
                                    <div class="number-lg balance">
                                        <div class="spinner-border spinner-border-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-wg7-foot">
                                    <span class="nk-wg7-note">Last activity at
                                        <span>{{ Helper::format_date(date('Y-m-d H:i:s'), 'l, d M Y H:i') }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light alert-icon alert-icon mt-2 warning_address" hidden>
                        <em class="icon ni ni-cross-circle text-danger"></em> You have not added a <b class="text-danger">wallet address</b>, add a wallet address <a href="{{ route('dashboard.wallet.address') }}">here</a>
                    </div>

                    @if (Auth::user()->is_active_2fa != '1')
                    <div class="alert alert-light alert-icon alert-icon mt-2">
                        <em class="icon ni ni-cross-circle text-danger"></em> You have not activated <b class="text-danger">2FA authenticator</b>, activate 2FA authenticator <a href="{{ route('dashboard.authenticator') }}">here</a>
                    </div>
                    @endif

                    <div class="my-4">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <h5 class="title mb-0">Your Packages</h5>
                            {{-- <a href="{{ route('dashboard.mypackages') }}" class="fw-bold btn-see-all-pkg">See All</a> --}}
                        </div>
                        <div class="my-2">
                            <div class="row card-product">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="spinner-border spinner-border-sm text-warning me-2" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Loading your packages...
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-bordered">
                        <div class="nk-refwg">
                            <div class="nk-refwg-invite card-inner w-100 border-white">
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
                                        <div class="form-clip clipboard-init" data-clipboard-target="#refUrl"
                                            data-success="Copied" data-text="Copy Link"><em
                                                class="clipboard-icon icon ni ni-copy"></em> <span
                                                class="clipboard-text">Copy Link</span></div>
                                        <div class="form-icon">
                                            <em class="icon ni ni-link-alt"></em>
                                        </div>
                                        <input type="text" class="form-control copy-text" id="refUrl"
                                            value="{{ route('register') }}?ref={{ Auth::user()->referral_code }}">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="nk-refwg-stats card-inner bg-lighter">
                                <div class="nk-refwg-group g-3">
                                    <div class="nk-refwg-name">
                                        <h6 class="title">Team Information <em class="icon ni ni-info"
                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                title="Referral Informations"></em></h6>
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
                                        <a href="#" class="btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em
                                                class="icon ni ni-more-h"></em></a>
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
                            </div> --}}
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

                {{-- <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-lg">
                            <div class="align-center flex-wrap flex-md-nowrap g-4">
                                <div class="nk-block-image w-120px flex-shrink-0">
                                    <img src="{{ asset('landing/images/home_icon_6.svg') }}">
                                </div>
                                <div class="nk-block-content">
                                    <div class="nk-block-content-head px-lg-4">
                                        <h5>We’re here to help you!</h5>
                                        <p class="text-soft">Ask a question or file a support ticket, manage request,
                                            report an issues. Our team support team will get back to you by email.</p>
                                    </div>
                                </div>
                                <div class="nk-block-content flex-shrink-0">
                                    <a href="#" class="btn btn-lg btn-outline-primary">Get Support Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endif
        </div>
    </div>

    <div class="modal fade" id="modalchallenge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daily Challenge</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="mb-1">Date</label>
                            <span class="form-control">{{ date('d F Y') }}</span>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="package_id">
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-1">Daily Challenge</label>
                            <select class="form-select master_daily_challenge" name="dialy_challenge_id" required>

                            </select>
                        </div>
                        <div class="typeInput" hidden>
                            <div class="form-group mb-2 file" hidden>
                                <label class="mb-1">Please upload a picture</label>
                                <input type="file" name="file_path" class="form-control">
                                <span class="small text-danger file_path_err"></span>
                            </div>
                            <div class="form-group mb-2 write" hidden>
                                <label class="mb-1">Please Write Your Review</label>
                                <textarea name="text_review" class="form-control"></textarea>
                                <span class="small text-danger text_review_err"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalRedeem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center fs-5">
                <span>If you redeem now, you will get <span class="package_redeem_rate"></span>%<br>from your donation</span>
                <br>
                <span><span class="percentage">0</span>% x <span class="rdonation">0</span> x <span class="package_redeem_rate">0</span>% = <span class="estimated">0</span></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary requestRedeem">Request</button>
            </div>
          </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('account/assets/js/charts/chart-crypto.js?ver=3.0.2') }}"></script>

    <script>
        var user_id       = "{{ Auth::user()->id }}";
        var userPackageId = '';
        getAddress();
        getMasterDailyChallenge();

        $('.master_daily_challenge').change(function () {
            let dialy_challenge_id = $(this).val();
            let isType             = $('.master_daily_challenge option:selected').attr('input-type');
            $('.write').attr('hidden', (isType == '1' ? false : true));
            $('textarea[name="text_review"]').attr('required', (isType == '1' ? true : false));

            $('.file').attr('hidden', (isType == '1' ? true : false));
            $('input[name="file_path"]').attr('required', (isType == '1' ? false : true));
            $('.typeInput').attr('hidden', false);

            $('input[name="file_path"]').val('');
            $('.file_path_err,.text_review_err').html('');
        });

        $.ajax({
            url  : '{{ route('product.list') }}',
            data : {
                id : user_id
            },
            success: function(r) {
                let content = '';
                    for (let inx      = 0; inx <= (r.master.length -1); inx++) {
                        let item      = r.master[inx];
                        let value     = r.data.find(it => it.package_id == item.id);
                        let menu      = '';
                        let compliment= '';
                        if (value) {
                            menu += `
                                <li>
                                    <a class="dropdown-item ${value && (value?.package_type != '0') ? '' : 'disabled'}" href="javascript:void(0);" onclick="blessing('${item.id}', '${user_id}', '${item.amount}')">Daily Blessing</a>
                                </li>
                                <li>
                                    <a class="dropdown-item ${value && (value?.package_type != '0') ? '' : 'disabled'}" href="javascript:void(0);" onclick="challenge('${item.id}')">Daily Challenge</a>
                                </li>
                                <li>
                                    <a class="dropdown-item ${value && (value?.percentage > 0) ? '' : 'disabled'}" href="javascript:void(0)" onclick="redeemGift('${value?.id}')">Redeem</a>
                                </li>
                            `;

                        }

                        if (value && (value?.package_type == '0')) {
                            compliment = '<span class="badge bg-light text-dark">Compliment</span>';
                        }

                        content += `
                            <div class="col-lg-3 col-12">
                                <div class="card bg-light">
                                    <div class="${(value ? '' : 'not-own')}"></div>
                                    <div class="nk-wgw sm">
                                        <div class="nk-wgw-inner">
                                            <div class="d-flex flex-row justify-content-between nk-wgw-name header-pack-color mb-2" style="background-color : ${item.color}">
                                                <h5 class="nk-wgw-title title">Package ${item.name}</h5>
                                            </div>
                                            <div class="gauge-container">
                                                <div class="gauge" ${value ? 'data-value="'+value.percentage+'"' : 'data-value="0"'}></div>
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="dropdown">
                                                    <button class="px-5 btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Menu
                                                    </button>
                                                    <ul class="dropdown-menu menu-custom" aria-labelledby="dropdownMenuButton1">
                                                        ${menu}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                if (r.data.length > 0) {
                    $('.btn-see-all-pkg').show();
                }else {
                    // content += `<div class="col-lg-4 col-12">You dont have any package, lets go donate a package <a href="{{ route('dashboard.packages') }}">here</a>, be sure your balance is enought.</div>`;
                    $('.btn-see-all-pkg').hide();
                }

                $('.card-product').html(content);
                setMeter();
            }
        });

        function redeemGift(id) {
            userPackageId = id;
            $.ajax({
                url  : '{{ route('product.redeem.info') }}',
                data : {
                    id     : id,
                    userId : user_id
                },
                dataType : 'jSON',
                success : function(r) {
                    let keys = Object.keys(r);
                    keys.map((item, index) => {
                        $(`.${item}`).html(r[item]);
                    })
                    $('#modalRedeem').modal('show');
                }
            })
        }

        $('.requestRedeem').click(function () {
            $.ajax({
                url  : '{{ route('product.redeem.process') }}',
                type : 'POST',
                data : {
                    id     : userPackageId,
                    userId : user_id
                },
                dataType : 'jSON',
                error: function(request, status, error) {
                    showResponseHeader(request);
                },
                success : function(r) {
                    NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                        position: "top-right"
                    });
                    $('#modalRedeem').modal('hide');
                }
            })
        });

        function blessing(id, user, amount) {
            Swal.fire({
                title              : "Confirmation",
                text               : `You will earn ${amount} per day. Do you want to claim now?`,
                showCloseButton    : true,
                showCancelButton   : true,
                confirmButtonText  : "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url      : "{{ route('daily.blessing.process') }}",
                        data     : {
                            id      : id,
                            user_id : user
                        },
                        type     : "POST",
                        dataType : "jSON",
                        error: function(request, status, error) {
                            showResponseHeader(request);
                        },
                        success  : function(r) {
                            NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                                position: "top-right"
                            });

                            $(".datatable").DataTable().ajax.reload();
                        }
                    })
                }
            })
        }

        function challenge(id) {
            $('input[name="package_id"]').val(id);
            $('#modalchallenge').modal('show');
        }

        $("#modalchallenge").on("hidden.bs.modal", function () {
            $('input[name="package_id"]').val('');
            $('input[name="file_path"]').val('');
            $('textarea[name="text_review"]').val('');
            $('select[name="dialy_challenge_id"]').val('');
            $('select[name="dialy_challenge_id"]').val('');
            $('.typeInput').attr('hidden', true);
            $('.file_path_err,.text_review_err').html('');
        });

        NioApp.DataTable('.datatable', {
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('request.list') }}',
                type: 'POST',
                data: {
                    user_id: user_id
                }
            },
            columns: [{
                    data: 'submitted_at'
                },
                {
                    data: 'type'
                },
                {
                    data: 'description'
                },
                {
                    data: 'file'
                },
                {
                    data: 'status',
                    className : 'text-center'
                }
            ],
            ordering: false
        });

        $("#form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url         : "{{ route('daily.challange.process') }}",
                type        : "POST",
                data        : formData,
                dataType    : "jSON",
                contentType : false,
                cache       : false,
                processData : false,
                error       : function(request, status, error) {
                    showResponseHeader(request);
                },
                success     : function(r) {
                    NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                        position: "top-right"
                    });

                    if (r.success) {
                        setTimeout(() => {
                            location.href = "{{ route('dashboard') }}";
                        }, 1000);
                    }
                }
            })
        });
    </script>
@endpush
