@extends('layouts.dashboard')

@section('content')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Donation Packages</h3>
                    </div>
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li>
                                <a href="{{ route('admin.package.form') }}" class="btn btn-primary">
                                    <span>Add Donation Package</span> <em class="icon ni ni-arrow-long-right"></em>
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
                                    <th>Level</th>
                                    <th>Package</th>
                                    <th>Value</th>
                                    <th>Donation</th>
                                    <th>Join Fee</th>
                                    <th>Daily Blassing</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
                url: "{{ route('admin.package.list') }}",
                type: "POST",
                data: {
                    user_id: "{{ Auth::user()->id }}"
                }
            },
            columns: [
                {
                    data: "level",
                    className: "text-center"
                },
                {
                    data: "name"
                },
                {
                    data: "rvalue",
                    className: "text-end"
                },
                {
                    data: "rdonation",
                    className: "text-end"
                },
                {
                    data: "rjoin_fee",
                    className: "text-end"
                },
                {
                    data: "rdaily_blessing",
                    className: "text-end"
                },
                {
                    data: "action",
                    className: "text-center"
                },
            ],
            ordering: false
        });

        function deleting(id) {
            Swal.fire({
                title             : "Confirmation",
                text              : "Are you sure to delete this donation package?",
                showCloseButton   : true,
                showCancelButton  : true,
                confirmButtonText : "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url      : "{{ route('admin.package.delete') }}",
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
    </script>
@endpush
