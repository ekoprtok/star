@extends('layouts.landing')

@section('content')
<section class="section section-feature pb-0" id="feature">
    <div class="container">
        <div class="row align-items-center justify-content-lg-between g-gs">
            <div class="col-lg-5">
                <div class="img-block img-block-s1 left">
                    <img src="http://localhost:8000/landing/images/gfx/a.png" alt="img">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-block me-xl-5">
                    <h2 class="title">Build a better software with Our <span class="text-primary">Conceptual Apps</span> and Modern <span class="text-pink">UI Elements</span></h2>
                    <div class="review review-s3">
                        <div class="review-content">
                            <div class="review-rating rating rating-sm">
                                <ul class="rating-stars">
                                    <li><em class="icon ni ni-star-fill"></em></li>
                                    <li><em class="icon ni ni-star-fill"></em></li>
                                    <li><em class="icon ni ni-star-fill"></em></li>
                                    <li><em class="icon ni ni-star-fill"></em></li>
                                    <li><em class="icon ni ni-star-fill"></em></li>
                                </ul>
                            </div>
                            <div class="review-text">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                                <h6 class="review-name text-dark">Samuel Mishin</h6>
                            </div>
                        </div>
                    </div>
                    <ul class="btns-inline">
                        <li><a href="#" class="btn btn-lg btn-primary"><span>Learn More</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
