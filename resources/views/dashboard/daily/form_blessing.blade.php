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
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label class="form-label">Daily Blassing</label>
                        <textarea class="form-control"></textarea>
                     </div>

                     <button class="btn btn-primary">Submit</button>
                  </div>
               </div>
            </div>
         </div>
       </div>
    </div>
 </div>
@endsection

@push('script')

@endpush
