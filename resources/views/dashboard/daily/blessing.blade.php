@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Daily Blessing</h3>
             </div>
             <div class="nk-block-head-content">
                <ul class="nk-block-tools gx-3">
                    <li>
                        <a href="{{ route('admin.daily.blessing.form') }}" class="btn btn-primary">
                            <span>Add Daily Blassing</span> <em class="icon ni ni-arrow-long-right"></em>
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
                                <th>No</th>
                                <th>Daily</th>
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
            url  : '{{ route('admin.daily.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'no' },
            { data: 'daily' },
            { data: 'action' },
        ],
        ordering : false
    });
</script>
@endpush
