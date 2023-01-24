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
                <div class="row g-gs">
                    @php
                        $data = ['Regular', 'Premium', 'Advance', 'Solitaire'];
                    @endphp
                    @for ($i = 0; $i <= 3; $i++)
                        <div class="col-lg-4 col-12">
                            <div class="card bg-light">
                                <div class="nk-wgw sm">
                                    <div class="nk-wgw-inner">
                                        <div class="nk-wgw-name">
                                            <h5 class="nk-wgw-title title">Package {{ $data[$i] }}</h5>
                                        </div>
                                        <div class="gauge-container">
                                            <div class="gauge"></div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-center">
                                            <a class="nk-wgw-balance btn btn-primary me-3" href="javascript:void()"
                                                onclick="alerts()">
                                                Daily Blessing
                                            </a>
                                            <a class="nk-wgw-balance btn btn-primary" href="javascript:void()"
                                                data-bs-toggle="modal" data-bs-target="#modalchallenge">
                                                Daily Challenge
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalchallenge" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daily Challenge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label class="mb-1">Date</label>
                        <span class="form-control">29 Jan 2023</span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-1">Daily Challenge</label>
                        <select class="form-select">
                            <option>Memberikan ulasan di web</option>
                            <option>Memberikan review di web</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="mb-1">Please upload a picture</label>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $.ajax({
            url: '{{ route('product.list') }}',
            success: function(r) {
                let content = '';
                r.data.map((item, index) => {
                    content += `
                    <div class="col-4">
                        <div class="card bg-light">
                            <div class="nk-wgw sm">
                                <div class="nk-wgw-inner">
                                    <div class="nk-wgw-name">
                                        <h5 class="nk-wgw-title title">Package Regular</h5>
                                    </div>
                                    <div class="gauge-container">
                                        <div class="gauge"></div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center">
                                        <a class="nk-wgw-balance btn btn-primary me-3" href="javascript:void()" onclick="alerts()">
                                            Dialy Blasing
                                        </a>
                                        <a class="nk-wgw-balance btn btn-primary" href="javascript:void()" onclick="alerts()">
                                            Dialy Challenge
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                });
                $('.card-product').html(content);
            }
        });

        function alerts() {
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure to buy this package?',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            })
        }
    </script>
@endpush
