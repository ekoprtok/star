@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">OTP</h3>
                    </div>
                </div>
            </div>
            <div class="nk-block col-sm-6">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <div>
                            <div class="form-group">
                                <label class="mb-1">Authenticator Code</label>
                                <input type="text" name="authenticator_code" class="form-control" autocomplete="off" autofocus>
                                <span class="text-danger small authenticator_code_err"></span>
                            </div>
                            <a class="btn btn-primary submit-code" href="javascript:void(0);">Submit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    let email = '{{ Auth::user()->email }}';
    $('.submit-code').click(function () {
        $.ajax({
            url : '{{ route('2fa.check') }}',
            data : {
                authenticator_code  : $('input[name="authenticator_code"]').val(),
                email               : email
            },
            dataType : 'jSON',
            error: function(request, status, error) {
                showResponseHeader(request);
            },
            success : function (r) {
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
