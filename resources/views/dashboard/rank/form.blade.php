@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
            <a href="{{ route('admin.rank') }}" class="nk-block-head-content d-flex flex-row align-items-center justify-content-center">
                <i class="bi bi-chevron-left fs-4"></i>
                <h3 class="nk-block-title page-title">Manage Rank</h3>
             </a>
          </div>
       </div>
       <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
               <div class="row gy-4">
                  <form method="POST" class="buysell-form" id="form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="name" required>
                                <input type="hidden" name="id" value={{ isset($id) ? $id : '' }}>
                                <small class="text-danger name_err"></small>
                             </div>

                             <div class="form-group">
                                <label class="form-label">Direct Donator</label>
                                <input type="number" min="0" class="form-control" name="direct_donator" required>
                                <small class="text-danger direct_donator_err"></small>
                             </div>

                             <div class="form-group">
                                <label class="form-label">Must Have Direct Downline</label>
                                <input type="number" min="0" class="form-control" name="must_have_dwline" required>
                                <small class="text-danger must_have_dwline _err"></small>
                             </div>

                             <div class="form-group">
                                <label class="form-label">Total Team Donator</label>
                                <input type="number" min="0" class="form-control" name="total_team_donator" required>
                                <small class="text-danger total_team_donator_err"></small>
                             </div>

                             <div class="form-group">
                                <label class="form-label">Level</label>
                                <select name="level" class="form-select" required>
                                     <option value="1">1</option>
                                     <option value="2">2</option>
                                     <option value="3">3</option>
                                     <option value="4">4</option>
                                     <option value="5">5</option>
                                </select>
                                <small class="text-danger level_err"></small>
                             </div>

                             <div class="form-group">
                                <label class="form-label">Difference Rate</label>
                                <input type="number" min="0" step=".001" class="form-control" name="diff_rate" required>
                                <small class="text-danger diff_rate_err"></small>
                             </div>

                             <a class="btn btn-outline-primary me-1" href="{{ route('admin.rank') }}">Cancel</a>
                            <button class="btn btn-primary">Save</button>
                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <label class="form-label">Total Rank Donation</label>
                                <input type="number" min="0" class="form-control" name="rrank_donation_total" required>
                                <small class="text-danger rrank_donation_total_err"></small>
                             </div>

                            <div class="form-group">
                                <label class="form-label">Reward</label>
                                <input type="number" min="0" class="form-control" name="rreward" required>
                                <small class="text-danger rreward_err"></small>
                             </div>

                            <div class="form-group">
                                <label class="form-label">Social Event</label>
                                <input type="number" min="0" class="form-control" name="rsocial_event" required>
                                <small class="text-danger rsocial_event_err"></small>
                             </div>

                         </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
       </div>
    </div>
 </div>
@endsection

@push('script')
<script>

    $("#form").submit(function(e){
        e.preventDefault();
        $.ajax({
            url      : "{{ route('admin.rank.process') }}",
            type     : "POST",
            data     : $('#form').serialize(),
            dataType : "jSON",
            error: function (request, status, error) {
                showResponseHeader(request);
            },
            success  : function (r) {
                NioApp.Toast(r.message, (r.success ? "success" : "error"), {
                    position: "top-right"
                });

                if (r.success) {
                    setTimeout(() => {
                        location.href = "{{ route('admin.rank') }}";
                    }, 1000);
                }
            }
        })
    });

    @if ($id)
        $.ajax({
            url      : "{{ route('admin.rank.edit', ['id' => $id]) }}",
            dataType : "jSON",
            error: function (request, status, error) {
                showResponseHeader(request);
            },
            success  : function (response) {
                setEditProps(response)
            }
        })
    @endif

</script>
@endpush
