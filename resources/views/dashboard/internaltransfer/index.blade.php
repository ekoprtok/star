@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Withdrawal Request</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
               <div class="row gy-4">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label class="form-label">Date</label>
                        <div class="form-control-wrap">
                            <span class="form-control">12 January 2022</span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Transfer To (email address)</label>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Amount*</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label class="form-label">Wallet Balance</label>
                        <div class="form-control-wrap">
                            <h3>$150</h3>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-6">
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
