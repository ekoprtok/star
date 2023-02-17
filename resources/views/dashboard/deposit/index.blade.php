@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Deposit Request</h3>
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
                                    <input type="hidden" name="file_path">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Amount*</label>
                                <div class="form-control-wrap">
                                    <input type="number" step=".01" min="{{ Helper::config('minimum_deposit') }}" class="form-control" name="amount">
                                    <span class="text-danger amount_err"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Please Upload a Picture</label>
                                <div class="form-control-wrap">
                                    <div class="upload-zone">
                                        <div class="dz-message" data-dz-message>
                                            <span class="dz-message-text">Drag and drop file</span>
                                            <span class="dz-message-or">or</span>
                                            <a class="btn btn-primary">SELECT</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger file_path_err"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Wallet Address</label>
                                <div class="form-control-wrap">
                                    <div class="form-clip clipboard-init" data-clipboard-target="#refUrl"
                                        data-success="Copied" data-text="Copy Link"><em
                                            class="clipboard-icon icon ni ni-copy"></em> <span
                                            class="clipboard-text">Copy Link</span></div>
                                    <div class="form-icon">
                                        <em class="icon ni ni-wallet-saving"></em>
                                    </div>
                                    <input type="text" class="form-control copy-text" id="refUrl"
                                        value="{{ Helper::config('deposit_address') }}">
                                </div>
                            </div>

                            <div>
                                <ul>
                                    <li style="list-style-type: circle">Please don’t deposit any other digital assets except <b>USDT(TRC20)</b> to the above address. Otherwise, you may lose your assets permanently.</li>
                                    <li style="list-style-type: circle"><b>Minimum</b> deposit amount: <b>{{ Helper::config('minimum_deposit') }} USDT(TRC20)</b>. Any deposits less than the minimum will not be credited or refunded.</li>
                                    <li style="list-style-type: circle">Only Send USDT to this address.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-process">Submit</button>
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
            url: "{{ route('deposit.process') }}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "jSON",
            beforeSend: function() {
                $('.btn-process').attr('disabled', true);
            },
            error: function(request, status, error) {
                $('.btn-process').attr('disabled', false);
                showResponseHeader(request);
            },
            success: function(r) {
                NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                    position: "top-right"
                });

                setTimeout(() => {
                    $('.btn-process').attr('disabled', false);
                }, 1000);

                if (r.success) {
                    setTimeout(() => {
                        location.href = "{{ route('dashboard') }}";
                    }, 1000);
                }
            }
        })
    });

    NioApp.Dropzone.init = function () {
        NioApp.Dropzone('.upload-zone', {
            url           : '{{ route('deposit.uploadImage') }}',
            maxFiles      : 1,
            acceptedFiles : 'image/jpeg,image/png,application/pdf',
            autoDiscover  : true,
            sending: function(file, xhr, formData) {
                // formData.append("invoice", $('input[name="invoice"]').val());
            },
            headers       : {
                Authorization : 'Bearer {{ Auth::user()->web_token }}'
            },
            accept : function(file, done) {
                done();
            },
            init : function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            },
            success: function(file, response) {
                NioApp.Toast(response.message, (response.success ? 'success' : 'error'), {
                    position: 'top-right'
                });
                if (response.success) {
                    $('input[name="file_path"]').val(response.data);
                }
            }
        });
    }
</script>
@endpush
