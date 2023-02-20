@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Social Event Unapprove</h3>
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
                                <th>Event At</th>
                                <th>User</th>
                                <th>Desciption</th>
                                <th>File</th>
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

<div class="modal fade" id="modalProof" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center fs-5">
                <img src="" class="img-proof">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            url  : '{{ route('admin.social.event.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'submitted_at' },
            { data: 'event_at' },
            { data: 'email' },
            { data: 'description', className : 'text-center' },
            { data: 'file_path' },
            { data: 'status', className : 'text-center' },
            { data: 'action', className : 'text-center' },
        ],
        ordering : false
    });

    function process(id, status) {
        Swal.fire({
            title             : "Confirmation",
            text              : `Are you sure to ${(status == '1' ? 'approve' : 'rejected')} this social event?`,
            showCloseButton   : true,
            showCancelButton  : true,
            confirmButtonText : "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url      : "{{ route('admin.social.event.process') }}",
                    data     : {
                        id             : id,
                        status         : status,
                        user_id        : "{{ Auth::user()->id }}"
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

    function modalPop(url) {
        $('#modalProof').modal('show');
        $('.img-proof').attr('src', url);
    }
</script>
@endpush
