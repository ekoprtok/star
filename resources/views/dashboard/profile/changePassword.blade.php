@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Change Password</h3>
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
                                        <label class="form-label">Current Password</label>
                                        <div class="form-control-wrap">
                                            <input type="password" name="old_password" class="form-control" required>
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <span class="text-danger small old_password_err"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control" name="new_password" required>
                                            <span class="text-danger small new_password_err"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Confirm New Password</label>
                                        <div class="form-control-wrap">
                                            <input type="password" class="form-control" name="new_password_confirmation">
                                            <span class="text-danger new_password_confirmation_err"></span>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary">Change Password</button>
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
                url: "{{ route('change.password.process') }}",
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
                            location.href = "{{ route('dashboard.change.password') }}";
                        }, 1000);
                    }
                }
            })
        });
    </script>
@endpush
