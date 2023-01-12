@extends('layouts.landing')

@section('content')
<section class="section section-feature pb-0">
    <div class="container">
        <div class="row flex-row-reverse align-items-center justify-content-between g-gs">
            <div class="col-lg-5">
                <div class="img-block img-block-s1 right">
                    <img src="{{ asset('landing/images/gfx/b.png') }}" alt="img">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-block">
                    <h2 class="title">Some unique features and awesome experience</h2>
                    <div class="g-gs">
                        <div class="service service-s3">
                            <div class="service-icon styled-icon styled-icon-s3 text-primary">
                                <img src="{{ asset('landing/images/home_icon_4.svg') }}" class="w-50">
                            </div>
                            <div class="service-text">
                                <h4 class="title">Easy to manage</h4>
                                <p>Many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>
                            </div>
                        </div>
                        <div class="service service-s3">
                            <div class="service-icon styled-icon styled-icon-s3 text-success">
                                <img src="{{ asset('landing/images/home_icon_5.svg') }}" class="w-50">
                            </div>
                            <div class="service-text">
                                <h4 class="title">A complete feature</h4>
                                <p>Slightly variations of passages available the majority have suffered alteration even slightly believable.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
