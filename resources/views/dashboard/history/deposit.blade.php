@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Deposit Unapprove</h3>
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
                                <th>Amount</th>
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

<div class="modal fade" id="confirm" tabindex="-1" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" readonly>
                    <input type="hidden" name="id">
                    <input type="hidden" name="wallet_id">
                </div>
                <div class="form-group">
                    <label>Received Amount</label>
                    <input type="number" min="0" class="form-control" name="received_amount">
                    <small class="text-danger received_amount_err"></small>
                </div>
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-process" onclick="_process('2')">Reject</button>
                <button type="button" class="btn btn-primary btn-process" onclick="_process('1')">Approve</button>
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
            url  : '{{ route('deposit.list') }}',
            type : 'POST',
            data : {
                user_id : '{{ Auth::user()->id }}'
            }
        },
        columns: [
            { data: 'submitted_at' },
            { data: 'email' },
            { data: 'amount' },
            { data: 'file_path' },
            { data: 'status' },
            { data: 'action', className : 'text-center' },
        ],
        ordering : false
    });

    function _process(status) {
        let id              = $('input[name="id"]').val();
        let wallet_id       = $('input[name="wallet_id"]').val();
        let received_amount = $('input[name="received_amount"]').val();

        process(id, status, wallet_id, received_amount);
    }

    $('input[name="received_amount"]').keyup(function () {
        let amount     = $('input[name="amount"]').val();
        let thisAmount = $(this).val();
        $('textarea[name="notes"]').val('The amount receive is '+thisAmount);
        if (parseFloat(thisAmount) > parseFloat(amount)) {
            $('input[name="received_amount"]').val(amount);
            $('textarea[name="notes"]').val('The amount receive is '+amount);
        }
    });

    function view(id, wallet_id, amount) {
        $('input[name="id"]').val(id);
        $('input[name="wallet_id"]').val(wallet_id);
        $('input[name="amount"]').val(amount);
        $('input[name="received_amount"]').val(amount);
        $('textarea[name="notes"]').val('The amount receive is '+amount);
        $('#confirm').modal('show');
    }

    function process(id, status, wallet_id, received_amount) {
        Swal.fire({
            title             : "Confirmation",
            text              : `Are you sure to ${(status == '1' ? 'approve' : 'rejected')} this deposit?`,
            showCloseButton   : true,
            showCancelButton  : true,
            confirmButtonText : "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url      : "{{ route('admin.deposit.process') }}",
                    data     : {
                        id              : id,
                        status          : status,
                        user_wallet_id  : wallet_id,
                        user_id         : "{{ Auth::user()->id }}",
                        received_amount : received_amount,
                        notes           : $('textarea[name="notes"]').val()
                    },
                    type : "POST",
                    dataType : "jSON",
                    beforeSend: function() {
                        $('.btn-process').attr('disabled', true);
                    },
                    error: function(request, status, error) {
                        $('.btn-process').attr('disabled', false);
                        showResponseHeader(request);
                    },
                    success  : function(r) {
                        $('.btn-process').attr('disabled', false);
                        NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                            position: "top-right"
                        });
                        if (r.success) {
                            $('#confirm').modal('hide');
                        }
                        $(".datatable").DataTable().ajax.reload();
                    }
                })
            }
        })
    }
</script>
@endpush
