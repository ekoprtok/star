@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Manage Authenticator</h3>
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
                                        <label class="form-label">Google Authenticator</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="checkbox2fa" {{ (Auth::user()->is_active_2fa == '1') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="checkbox2fa">Deactive</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="containerScanner" hidden>
                                        <div class="qrscan"></div>
                                        <div class="my-2">You can use two factor authentication by scanning the barcode below. Alternatively, you can use the following code: <b class="secret_code"></b></div>
                                        <div class="form-group">
                                            <label for="">Authenticator Code</label>
                                            <input type="text" name="authenticator_code" class="form-control">
                                            <span class="text-danger small authenticator_code_err"></span>
                                        </div>
                                        <a class="btn btn-primary submit-code" href="javascript:void(0);">Submit</a>
                                    </div>
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
    let email = '{{ Auth::user()->email }}';
    $("#checkbox2fa").change(function() {
        if(this.checked) {
            Swal.fire({
                title              : "Confirmation",
                text               : `Are you sure to deactive authenticator?`,
                showCloseButton    : true,
                showCancelButton   : true,
                confirmButtonText  : "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    get2faCode();
                }else {
                    $('#checkbox2fa').prop('checked', false);
                }
            })
        }else {
            Swal.fire({
                title              : "Confirmation",
                text               : `Are you sure to deactive authenticator?`,
                showCloseButton    : true,
                showCancelButton   : true,
                confirmButtonText  : "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : '{{ route('2fa.deactivate') }}',
                        data : {
                            email : email
                        },
                        dataType : 'jSON',
                        success : function (r) {
                            NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                                position: "top-right"
                            });

                            if (r.success) {
                                setTimeout(() => {
                                    location.href = "{{ route('dashboard.authenticator') }}";
                                }, 1000);
                            }
                        }
                    });
                }else {
                    $('#checkbox2fa').prop('checked', true);
                }
            })
        }
    });

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
                        location.href = "{{ route('dashboard.authenticator') }}";
                    }, 1000);
                }
            }
        })
    });

    function get2faCode() {
        $.ajax({
            url : '{{ route('2fa.request') }}',
            data : {
                email : email
            },
            dataType : 'jSON',
            success : function (r) {
                $('.qrscan').html(r.qrimage);
                $('.secret_code').html(r.secret);
                $('.containerScanner').attr('hidden', false);
            }
        });
    }
</script>
@endpush
