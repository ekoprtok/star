@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Daily</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
               <div class="row gy-4">
                  <form method="POST" class="buysell-form" id="form">
                    @csrf
                    <div class="col-sm-6">
                        <div class="form-group">
                           <label class="form-label">Daily Challenge</label>
                           <textarea class="form-control" name="name" required></textarea>
                           <input type="hidden" name="id" value={{ isset($id) ? $id : '' }}>
                           <input type="hidden" name="created_by" value={{ Auth::user()->id }}>
                           <small class="text-danger name_err"></small>
                        </div>

                        <div class="form-group">
                           <label class="form-label">Percentage</label>
                           <input type="number" class="form-control" name="percentage" max="100" required>
                           <small class="text-danger percentage_err"></small>
                        </div>

                        <button class="btn btn-primary">Submit</button>
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
            url      : "{{ route('admin.daily.process') }}",
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
                        location.href = "{{ route('admin.daily') }}";
                    }, 1000);
                }
            }
        })
    });

    @if ($id)
        $.ajax({
            url      : "{{ route('admin.daily.edit', ['id' => $id]) }}",
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
