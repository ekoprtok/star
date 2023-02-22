@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
        <div class="nk-content-body">

            <div class="nk-block-head pb-4">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <div class="nk-block-des">
                            <p><span class="username"></span> | <span class="rank"></span></p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="nk-block">

                    <div class="card card-bordered h-100">
                        <div class="card-inner">
                            <div class="nk-wg7">
                                <div class="nk-wg7-stats">
                                    <div class="nk-wg7-title">Available balance in USD</div>
                                    <div class="number-lg balance_available">
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

                    <div class="my-4">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <h5 class="title mb-0">Packages <span class="username"></span></h5>
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
                </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('account/assets/js/charts/chart-crypto.js?ver=3.0.2') }}"></script>

    <script>
        var user_id       = "{{ $id }}";

        // info dashboard
        $.ajax({
            url      : "{{ route('admin.dashboard') }}",
            data     : {
                id : user_id
            },
            dataType : 'jSON',
            error: function(request, status, error) {
                showResponseHeader(request);
            },
            success: function(response) {
                setHtmlProps(response)
            }
        })

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
    </script>
@endpush
