@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Transaction History</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Type</th>
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
            url  : '{{ route('transaction.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'submitted_at' },
            { data: 'email' },
            { data: 'name' },
            { data: 'package_type' },
        ],
        ordering : false
    });
</script>
@endpush
