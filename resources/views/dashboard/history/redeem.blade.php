@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Package Redeem Unapprove</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Date Of Submitted</th>
                                <th>User</th>
                                <th>Package</th>
                                <th>Amount</th>
                                <th>Description</th>
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
    const userId = '{{ Auth::user()->id }}';
    NioApp.DataTable('.datatable', {
        processing: true,
        serverSide: true,
        ajax : {
            url  : '{{ route('admin.redeem.list') }}',
            type : 'POST',
            data : {
                user_id : userId
            }
        },
        columns: [
            { data: 'submitted_at' },
            { data: 'email' },
            { data: 'name' },
            { data: 'ramount', className : 'text-end' },
            { data: 'description' },
            { data: 'status', className : 'text-center' },
            { data: 'action', className : 'text-center' },
        ],
        ordering : false
    });

    function process(id, user_id, status) {
        Swal.fire({
            title             : "Confirmation",
            text              : `Are you sure to ${(status == '1' ? 'approve' : 'rejected')} this package redeem?`,
            showCloseButton   : true,
            showCancelButton  : true,
            confirmButtonText : "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url      : "{{ route('admin.redeem.process') }}",
                    data     : {
                        id      : id,
                        user_id : user_id,
                        status  : status
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
