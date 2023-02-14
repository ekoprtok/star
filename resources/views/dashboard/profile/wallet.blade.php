@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Manage Wallet Address</h3>
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
                                        <label class="form-label">Wallet Address</label>
                                        <div class="form-control-wrap">
                                            <input type="text" name="address" class="form-control" required>
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <span class="text-danger small address_err"></span>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary">Save</button>
                                </div>

                                <div class="col-sm-6">
                                    <div>
                                        <ul>
                                            <li style="list-style-type: circle">Minimum withdrawal amount : <b class="withdrawal_min"></b> USDT (TRC20).</li>
                                            <li style="list-style-type: circle">To ensure the safety of your funds, your withdrawal request will be manually reviewed, if your security strategy or password is changed. Please wait for phone calls or emails from our stuff.</li>
                                            <li style="list-style-type: circle">Please make sure that your computer and browser are secure and your information is protected from being tampered or leaked.</li>
                                        </ul>
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

        $('document').ready(function () {
            getAddress()
        });

        $("#form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('wallet.address.process') }}",
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
                            getAddress();
                        }, 1000);
                    }
                }
            })
        });
    </script>
@endpush
