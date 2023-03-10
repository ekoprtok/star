@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Internal Transfer</h3>
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
                              </div>
                           </div>
                           <div class="form-group">
                               <label class="form-label">Transfer To (email address)</label>
                               <div class="form-control-wrap">
                                   <input type="email" class="form-control" name="email">
                                   <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                                   <span class="text-danger email_err"></span>
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
                              <small>your available balance <small class="balance_available"></small></small>
                              <br>
                              <br>
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
    $("#form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('internal.process') }}",
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
