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

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Trx Date</th>
                                <th>Transaction Type</th>
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
            url  : '{{ route('dashboard.balance.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'trx_at' },
            { data: 'type', className : 'text-center' },
            { data: 'amount', className : 'text-end' },
        ],
        ordering : false
    });
</script>
@endpush
