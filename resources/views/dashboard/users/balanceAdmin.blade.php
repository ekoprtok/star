@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Wallet Balance</h3>
             </div>
          </div>
       </div>

       <div class="nk-block">
            <div class="d-flex flex-row align-items-center justify-content-between mb-3">
                <div class="card card-bordered h-100 w-50 me-2">
                    <div class="card-inner">
                        <div class="nk-wg7">
                            <div class="nk-wg7-stats">
                                <div class="nk-wg7-title">Owner Wallet Balance</div>
                                <div class="number-lg owner_balance">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-bordered h-100 w-50 mt-0 ms-2">
                    <div class="card-inner">
                        <div class="nk-wg7">
                            <div class="nk-wg7-stats">
                                <div class="nk-wg7-title">Owner Wallet Balance - Exchanger</div>
                                <div class="number-lg owner_balance_r">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="nk-block-title title">System Wallet</h5>
            <div class="card card-bordered card-preview mb-3">
                <div class="card-inner">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Trx Date</th>
                                <th>Transaction Type</th>
                                <th>User</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <h5 class="nk-block-title title">Real Wallet</h5>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table datatable2">
                        <thead>
                            <tr>
                                <th>Trx Date</th>
                                <th>Transaction Type</th>
                                <th>User</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
       </div>
    </div>
 </div>
@endsection

@push('script')
<script>
    NioApp.DataTable('.datatable', {
        processing: true,
        serverSide: true,
        ajax : {
            url  : '{{ route('admin.balance.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'trx_at' },
            { data: 'type' },
            { data: 'user'},
            { data: 'amount', className : 'text-end' },
        ],
        ordering : false
    });

    NioApp.DataTable('.datatable2', {
        processing: true,
        serverSide: true,
        ajax : {
            url  : '{{ route('admin.balance.real.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'trx_at' },
            { data: 'type' },
            { data: 'user'},
            { data: 'amount', className : 'text-end' },
        ],
        ordering : false
    });

    $.ajax({
        url : '{{ route('admin.balance.wallet') }}',
        dataType : 'jSON',
        error: function(request, status, error) {
            showResponseHeader(request);
        },
        success: function(response) {
            setHtmlProps(response)
        }
    })
</script>
@endpush
