@extends('layouts.dashboard')

@section('content')
    <div class="container-xl">
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
                                    <th>Price</th>
                                    <th>Value</th>
                                    <th>Donation</th>
                                    <th>Management Fee</th>
                                    <th>Daily Blessing</th>
                                    <th>Gift</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalGift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Send as Gift</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Package</label>
                    <span class="form-control package_name"></span>
                    <input type="hidden" class="package_id">
                </div>
                <div class="form-group">
                    <label>Send to Username/Email Address</label>
                    <input type="text" name="user" class="form-control">
                    <span class="text-danger small user_id_err"></span>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary submitGift">Send Package</button>
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
                    data: "price",
                    className: "text-end"
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
                    data: "gift",
                    className: "text-center"
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

        $('.submitGift').click(function () {
            if (!$('input[name="user"]').val()) {
                $('.user_id_err').html('user is required');
            }else {
                $('.user_id_err').html('');
                Swal.fire({
                    title              : "Confirmation",
                    text               : "Are you sure want to send this package as a gift?",
                    showCloseButton    : true,
                    showCancelButton   : true,
                    confirmButtonText  : "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url      : "{{ route('admin.package.gift.process') }}",
                            data     : {
                                package_id : $('.package_id').val(),
                                user       : $('input[name="user"]').val(),
                                admin_id   : '{{ Auth::user()->id }}'
                            },
                            type     : "POST",
                            dataType : "jSON",
                            error: function(request, status, error) {
                                showResponseHeader(request);
                            },
                            success  : function(r) {
                                $('#modalGift').modal('hide');
                                NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                                    position: "top-right"
                                });

                                $(".datatable").DataTable().ajax.reload();
                            }
                        })
                    }
                })
            }
        })

        function sendGift(id, name) {
            $('#modalGift').modal('show');
            $('.package_name').html(name);
            $('.package_id').val(id);
        }

        $("#modalGift").on("hidden.bs.modal", function () {
            $('.package_name').html('');
            $('.package_id').val('');
            $('input[name="user"]').val('');
        });
    </script>
@endpush
