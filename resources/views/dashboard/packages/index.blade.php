@extends('layouts.dashboard')

@section('content')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Donation Package</h3>
             </div>
          </div>
       </div>
       <div class="nk-block">
          <div class="row g-gs card-product">

          </div>
       </div>
    </div>
 </div>
@endsection

@push('script')

<script>
    $.ajax({
        url : '{{ route('product.list') }}',
        success : function (r) {
            let content = '';
            r.data.map((item, index) => {
                content += `
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-bordered pricing">
                        <div class="pricing-head">
                            <div class="pricing-title">
                                <h4 class="card-title title">${item.name}</h4>
                            </div>
                        </div>
                        <div class="pricing-body">
                            <ul class="pricing-features">
                                <li><span class="w-50">Donation</span> <span class="ms-auto">${item.rvalue}</span></li>
                                <li><span class="w-50">Join Fee</span> <span class="ms-auto">${item.rjoin_fee}</span></li>
                                <li class="fw-bold"><span class="w-50">Total</span> <span class="ms-auto">${item.rdonation}</span></li>
                            </ul>
                            <div class="pricing-action">
                                <a class="btn btn-outline-primary" onclick="buying('${item.idx}')">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    </div>
                `;
            });
            $('.card-product').html(content);
        }
    });

    function buying(id) {
        Swal.fire({
            title             : "Confirmation",
            text              : "Are you sure to buy this package?",
            showCloseButton   : true,
            showCancelButton  : true,
            confirmButtonText : "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url      : "{{ route('package.buy') }}",
                    data     : {
                        id      : id,
                        user_id : "{{ Auth::user()->id }}"
                    },
                    type : "POST",
                    dataType : "jSON",
                    error: function(request, status, error) {
                        showResponseHeader(request);
                    },
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
