@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Donation Packages</h3>
             </div>
             <div class="nk-block-head-content">
                <ul class="nk-block-tools gx-3">
                    <li>
                        <a href="{{ route('admin.package.add') }}" class="btn btn-primary">
                            <span>Add Donation Package</span> <em class="icon ni ni-arrow-long-right"></em>
                        </a>
                    </li>
                </ul>
            </div>
          </div>
       </div>
       <div class="nk-block">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Package</th>
                                <th>Value</th>
                                <th>Donation</th>
                                <th>Join Fee</th>
                                <th>Dialy Blassing</th>
                                <th>Action</th>
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
            url  : '{{ route('admin.package.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'level' },
            { data: 'name' },
            { data: 'value' },
            { data: 'donation' },
            { data: 'fee' },
            { data: 'dialy' },
            { data: 'action' },
        ],
        ordering : false
    });
</script>
@endpush
