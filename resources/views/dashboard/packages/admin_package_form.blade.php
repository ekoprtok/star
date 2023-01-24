@extends('layouts.dashboard')

@section('content')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Manage Donation Package</h3>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <form method="POST" class="buysell-form" id="form">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Package Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="name">
                                            <input type="hidden" name="id" value={{ isset($id) ? $id : '' }}>
                                            <input type="hidden" name="created_by" value={{ Auth::user()->id }}>
                                            <small class="text-danger name_err"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Package Value</label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control" name="rvalue">
                                            <small class="text-danger rvalue_err"></small>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Join Fee</label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control" name="rjoin_fee">
                                            <small class="text-danger rjoin_fee_err"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Level</label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control" name="level">
                                            <small class="text-danger level_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Donation</label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control" name="rdonation">
                                            <small class="text-danger rdonation_err"></small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Dialy Blassing</label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control" name="rdaily_blessing">
                                            <small class="text-danger rdaily_blessing_err"></small>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="form-label">Image Url</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div> --}}
                                </div>


                                {{-- <div>
                                <a href="" class="btn btn-primary">Add Percentage</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Generation</th>
                                        <th>Percentage</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                        <td>
                                            <a href="" class="text-danger">Delete</a>&nbsp;&nbsp;<a href=""
                                                class="text-primary">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                        <td>
                                            <a href="" class="text-danger">Delete</a>&nbsp;&nbsp;<a href=""
                                                class="text-primary">Edit</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                        <td>
                                            <a href="" class="text-danger">Delete</a>&nbsp;&nbsp;<a href=""
                                                class="text-primary">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> --}}

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
                url: "{{ route('admin.package.process') }}",
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
                            location.href = "{{ route('admin.package') }}";
                        }, 1000);
                    }
                }
            })
        });

        @if ($id)
            $.ajax({
                url: "{{ route('admin.package.edit', ['id' => $id]) }}",
                dataType: "jSON",
                error: function(request, status, error) {
                    showResponseHeader(request);
                },
                success: function(response) {
                    setEditProps(response)
                }
            })
        @endif
    </script>
@endpush
