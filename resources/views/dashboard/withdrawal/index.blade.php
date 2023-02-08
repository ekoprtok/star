@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Withdrawal Request</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <form method="post" id="form">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <div class="form-control-wrap">
                                    <span class="form-control">{{ date('d F Y') }}</span>
                                    <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Amount*</label>
                                <div class="form-control-wrap">
                                    <input type="number" step=".01" min="0" class="form-control" name="amount">
                                    <span class="text-danger amount_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Wallet Balance</label>
                                <div class="form-control-wrap">
                                    <h3 class="balance">0</h3>
                                </div>
                                <small>each withdrawal will be deducted by a fee of $<small class="withdrawal_fee"></small></small>
                                <br>
                                <br>
                                <label class="form-label">Estimated Value Received</label>
                                <div class="form-control-wrap">
                                    <h4 class="balance_estimated">0</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
         </div>
       </div>
    </div>
 </div>
@endsection

@push('script')
<script>
    $('input[name="amount"]').keyup(function() {
        const fee     = $('.withdrawal_fee').html();
        let value     = $(this).val();
        let estimated = parseFloat(value) - parseFloat(fee);
        $('.balance_estimated').html(estimated || 0);
    })

    $("#form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('withdraw.process') }}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "jSON",
            error: function(request, status, error) {
                showResponseHeader(request);
            },
            success: function(r) {
                NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                    position: "top-right"
                });

                if (r.success) {
                    setTimeout(() => {
                        location.href = "{{ route('dashboard') }}";
                    }, 1000);
                }
            }
        })
    });
</script>
@endpush
