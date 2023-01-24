@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Daily Challenges</h3>
             </div>
             <div class="nk-block-head-content">
                <ul class="nk-block-tools gx-3">
                    <li>
                        <a href="{{ route('admin.daily.form') }}" class="btn btn-primary">
                            <span>Add Daily Challenge</span> <em class="icon ni ni-arrow-long-right"></em>
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
                                <th>Percentage</th>
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
            url  : "{{ route('admin.daily.list') }}",
            type : 'POST',
            data : {
                user_id : "{{ Auth::user()->id }}"
            }
        },
        columns: [
            { data: 'no' },
            { data: 'name' },
            { data: 'percentage' },
            { data: 'action' },
        ],
        ordering : false
    });

    function deleting(id) {
        Swal.fire({
            title : 'Confirmation',
            text : 'Are you sure to delete this daily challenge?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText : 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url      : "{{ route('admin.daily.delete') }}",
                    type     : "DELETE",
                    data     : {
                        id : id
                    },
                    dataType : "jSON",
                    success : function(r) {
                        NioApp.Toast(r.message, (r.success ? 'success' : 'error'), {
                            position: 'top-right'
                        });

                        $('.datatable').DataTable().ajax.reload();
                    }
                })
            }
        })
    }
</script>
@endpush
