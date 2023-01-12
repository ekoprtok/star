@extends('layouts.landing')

@section('content')

    <section class="section section-service pb-0" id="service">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title">We provide various kind of service for you</h2>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="row justify-content-center text-center g-gs">
                    <div class="col-9 col-sm-7 col-md-4">
                        <div class="service service-s2">
                            <div class="service-icon styled-icon styled-icon-s2 bg-primary">
                                <img src="{{ asset('landing/images/home_icon_1.svg') }}" class="w-50">
                            </div>
                            <div class="service-text">
                                <h4 class="title">Advanced Statistics</h4>
                                <p>But I must explain to you how all this mistaken idea of pleasure.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 col-sm-7 col-md-4">
                        <div class="service service-s2">
                            <div class="service-icon styled-icon styled-icon-s2 bg-pink">
                                <img src="{{ asset('landing/images/home_icon_2.svg') }}" class="w-50">
                            </div>
                            <div class="service-text">
                                <h4 class="title">Powerful Admin</h4>
                                <p>Expound the actual teachings of the great explorer of the truth.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 col-sm-7 col-md-4">
                        <div class="service service-s2">
                            <div class="service-icon styled-icon styled-icon-s2 bg-success">
                                <img src="{{ asset('landing/images/home_icon_3.svg') }}" class="w-50">
                            </div>
                            <div class="service-text">
                                <h4 class="title">Security Updates</h4>
                                <p>Praising pain was born and I will give you a complete account.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section section-feature pb-0" id="feature">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between g-gs">
                <div class="col-lg-5">
                    <div class="img-block img-block-s1 left">
                        <img src="{{ asset('/landing/images/gfx/a.png') }}" alt="img">
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
    <section class="section section-feature bg-lighter">
        <div class="container">
            <div class="row align-items-center justify-content-between g-gs">
                <div class="col-lg-5">
                    <div class="img-block img-block-s1 left">
                        <img src="{{ asset('landing/images/gfx/c.png') }}" alt="img">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-block">
                        <h2 class="title">List building tools and lead generation</h2>
                        <p class="lead">But the majority have suffered alteration in some form, by injected humour, or randomised slightly believable.</p>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. </p>
                        <ul class="btns-inline">
                            <li><a href="#" class="btn btn-lg btn-primary"><span>Get The App</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-cta">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="text-block is-compact">
                        <div class="img-block h-150px mb-4">
                            <img src="{{ asset('landing/images/home_icon_6.svg') }}" class="w-25">
                        </div>
                        <h2 class="title">Get Started</h2>
                        <p class="lead">Over 60 million people have chosen Dashlite to power the place on the web they call “home” — join the family.</p>
                        <ul class="btns-inline justify-center">
                            <li>
                                <a href="{{ route('dashboard') }}" class="btn btn-xl btn-primary">Login To Cabinet</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
