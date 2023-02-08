@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Daily Challenges Unapprove</h3>
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
                                <th>Challenge</th>
                                <th>User</th>
                                <th>Package</th>
                                <th>Proof</th>
                                <th>Type</th>
                                <th>Status</th>
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
    const userId = "{{ Auth::user()->id }}";
    NioApp.DataTable('.datatable', {
        processing: true,
        serverSide: true,
        ajax : {
            url  : '{{ route('dialy.unapp.list') }}',
            type : 'POST',
            data : {
                user_id : userId
            }
        },
        columns: [
            { data: 'submitted_at' },
            { data: 'challenge' },
            { data: 'email' },
            { data: 'name' },
            { data: 'proof' },
            { data: 'isText' },
            { data: 'status', className : 'text-center' },
            { data: 'action', className : 'text-center' },
        ],
        ordering : false
    });

    function process(id, status) {
        Swal.fire({
            title             : "Confirmation",
            text              : `Are you sure to ${(status == '1' ? 'approve' : 'rejected')} this daily challenge?`,
            showCloseButton   : true,
            showCancelButton  : true,
            confirmButtonText : "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url      : "{{ route('admin.daily.challange.process') }}",
                    data     : {
                        id             : id,
                        status         : status,
                        user_id        : userId
                    },
                    type : "POST",
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
</script>
@endpush
