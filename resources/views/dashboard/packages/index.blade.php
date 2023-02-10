@extends('layouts.dashboard')

@section('content')
<div class="container-xl">
    <div class="nk-content-body">
       <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">
             <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Donation</h3>
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
                <div class="col-xl-3 col-sm-6">
                    <div class="pricing pricing-s2 card card-shadow card-bordered round-md d-block overflow-hidden">
                        <div class="card-inner card-inner-lg">
                            <img class="h-160px package-icon3" src="http://localhost:8000/landing/new_image/icon_packages-0${(index+1)}-new-min.png" alt="">
                            <h2 class=" fs-1 text-purple pb-3">${item.price}</h2>
                            <h5 class="pricing-title pb-0">Regular</h5>
                            <span class="sub-title">${item.gen_deep} generation kindness meter</span>
                            <hr class="hr border-light">
                            <ul class="pricing-feature list list-nostyle nodot">
                                <li>Donation : ${item.rdonation}</li>
                                <li>Joining Fee : ${item.rjoin_fee}</li>
                                <li>Daily Blessing : ${item.rdaily_blessing}/day</li>
                            </ul>

                            <div class="pricing-action">
                                <a class="btn btn-outline-primary" onclick="buying('${item.id}')">Buy Now</a>
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
