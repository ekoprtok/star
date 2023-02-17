@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Ranks</h3>
             </div>
             <div class="nk-block-head-content">
                <ul class="nk-block-tools gx-3">
                    <li>
                        <a href="{{ route('admin.rank.form') }}" class="btn btn-primary">
                            <span>Add Rank</span> <em class="icon ni ni-arrow-long-right"></em>
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
                                <th>Name</th>
                                <th>Direct Donator</th>
                                <th>Must Have Direct Downline</th>
                                <th>Total Team Donator</th>
                                <th>Total Rank Donation</th>
                                <th>Reward</th>
                                <th>Social Event</th>
                                <th>Difference Rate</th>
                                <th class="text-center">Action</th>
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
    const userId = "{{ Auth::user()->id }}";

    NioApp.DataTable(".datatable", {
        processing: true,
        serverSide: true,
        ajax : {
            url  : "{{ route('admin.rank.list') }}",
            type : "POST",
            data : {
                user_id : userId
            }
        },
        columns: [
            { data: "level" },
            { data: "name" },
            { data: "direct_donator", className : "text-center" },
            { data: "must_have_dwline", className : "text-center" },
            { data: "total_team_donator", className : "text-center" },
            { data: "rrank_donation_total", className : "text-end" },
            { data: "rreward", className : "text-end" },
            { data: "rsocial_event", className : "text-end" },
            { data: "diff_rate", className : "text-end" },
            { data: "action", className : "text-center" },
        ],
        ordering : false
    });

    function deleting(id) {
        Swal.fire({
            title             : "Confirmation",
            text              : "Are you sure to delete this rank?",
            showCloseButton   : true,
            showCancelButton  : true,
            confirmButtonText : "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url      : "{{ route('admin.rank.delete') }}",
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
