@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Percentage</h3>
                    </div>
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li>
                                <a href="javascript:void(0)" onclick="add()" class="btn btn-primary">
                                    <span>Add Percentage</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Generation</th>
                                    <th>Percentage</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPercent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Process Percentage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Generation</label>
                            <input type="text" class="form-control" name="gen">
                            <input type="hidden" name="package_id" value="{{ $package_id }}">
                            <input type="hidden" name="idx">
                            <small class="text-danger gen_err"></small>
                        </div>
                        <div class="form-group">
                            <label>Percentage</label>
                            <input type="text" class="form-control" name="percentage">
                            <small class="text-danger percentage_err"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        NioApp.DataTable(".datatable", {
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.package.percentage.list', ['id' => $package_id]) }}"
            },
            columns: [
                {
                    data: "gen",
                    className: "text-center"
                },
                {
                    data: "percentage",
                    className: "text-center"
                },
                {
                    data: "action",
                    className: "text-center"
                },
            ],
            ordering: false
        });

        function add(id) {
            $('#modalPercent').modal('show');
        }

        $("#form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.package.percentage.process') }}",
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

                    $('#modalPercent').modal('hide');
                    $(".datatable").DataTable().ajax.reload();
                }
            })
        });

        function deleting(id) {
            Swal.fire({
                title             : "Confirmation",
                text              : "Are you sure to delete this percentage?",
                showCloseButton   : true,
                showCancelButton  : true,
                confirmButtonText : "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url      : "{{ route('admin.package.percentage.delete') }}",
                        type     : "DELETE",
                        data     : {
                            id : id
                        },
                        dataType : "jSON",
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

        function editing(id) {
            $.ajax({
                url: "{{ route('admin.package.percentage.edit') }}",
                data : {
                    id : id
                },
                dataType: "jSON",
                error: function(request, status, error) {
                    showResponseHeader(request);
                },
                success: function(r) {
                    $('#modalPercent').modal('show');
                    setEditProps(r)
                }
            })
        }

        $('#modalPercent').on('hidden.bs.modal', function (event) {
            $('input[name="gen"]').val('');
            $('input[name="id"]').val('');
            $('input[name="percentage"]').val('');
        })

    </script>
@endpush
