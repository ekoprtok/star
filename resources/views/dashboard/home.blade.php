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
                                    <div class="number-lg balance">
                                        <div class="spinner-border spinner-border-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-wg7-foot">
                                    <span class="nk-wg7-note">Last activity at
                                        <span>{{ Helper::format_date(date('Y-m-d H:i:s'), 'l, d M Y') }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-4">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <h5 class="title mb-0">Your Packages</h5>
                            <a href="{{ route('dashboard.mypackages') }}" class="fw-bold btn-see-all-pkg">See All</a>
                        </div>
                        <div class="my-2">
                            <div class="row card-product">

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
                                        <div class="form-clip clipboard-init" data-clipboard-target="#refUrl"
                                            data-success="Copied" data-text="Copy Link"><em
                                                class="clipboard-icon icon ni ni-copy"></em> <span
                                                class="clipboard-text">Copy Link</span></div>
                                        <div class="form-icon">
                                            <em class="icon ni ni-link-alt"></em>
                                        </div>
                                        <input type="text" class="form-control copy-text" id="refUrl"
                                            value="{{ route('dashboard') }}?ref={{ Auth::user()->referral_code }}">
                                    </div>
                                </div>
                            </div>
                            <div class="nk-refwg-stats card-inner bg-lighter">
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
@endsection

@push('script')
    <script src="{{ asset('account/assets/js/charts/chart-crypto.js?ver=3.0.2') }}"></script>

    <script>
        var user_id = "{{ Auth::user()->id }}";
        $.ajax({
            url  : '{{ route('product.list') }}',
            data : {
                id : user_id
            },
            success: function(r) {
                let content = '';

                    for (let inx  = 0; inx <= (r.master.length -1); inx++) {
                        let item  = r.master[inx];
                        let value = r.data.find(it => it.package_id == item.id);
                        content += `
                            <div class="col-lg-3 col-12">
                                <div class="card bg-light">
                                    <div class="${(value ? '' : 'not-own')}"></div>
                                    <div class="nk-wgw sm">
                                        <div class="nk-wgw-inner">
                                            <div class="nk-wgw-name">
                                                <h5 class="nk-wgw-title title">Package ${item.name}</h5>
                                            </div>
                                            <div class="gauge-container">
                                                <div class="gauge" ${value ? '' : 'data-value="0"'}></div>
                                            </div>
                                            <div class="d-flex flex-row justify-content-center">
                                                <a class="btn btn-primary ${value ? '' : 'disabled'} btn-xs me-3" href="javascript:void(0);"
                                                    onclick="blessing('${item.id}', '${user_id}')">
                                                    Daily Blessing
                                                </a>
                                                <a class="btn btn-xs ${value ? '' : 'disabled'} btn-primary" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#modalchallenge">
                                                    Daily Challenge
                                                </a>
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
                    // content += `<div class="col-lg-4 col-12">You dont have any package, lets go buy a package <a href="{{ route('dashboard.packages') }}">here</a>, be sure your balance is enought.</div>`;
                    $('.btn-see-all-pkg').hide();
                }

                $('.card-product').html(content);
            }
        });

        function blessing(id, user) {
            Swal.fire({

            })
            Swal.fire({
                title              : "Confirmation",
                text               : "Are you sure want to request?",
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
    </script>
@endpush
