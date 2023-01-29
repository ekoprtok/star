@extends('layouts.landing')

@section('content')

    <section class="section section-service pb-0" id="service">
        <div class="container">
            <div class="d-flex flex-row mb-5 bg-light ps-5">
                <div class="d-flex flex-column align-items-start justify-content-center w-50 pe-3">
                    <div>
                        <h2>Helping Hand Community Club (H2C Club)</h2>
                    </div>
                    <p>Spread kindness to the world and bring prosperity to all</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-xl btn-primary">Join</a>
                </div>
                <div>
                    <img src="{{ asset('landing/images/hand.png') }}" alt="">
                </div>
            </div>

            <div class="row justify-content-center text-center mt-5">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title">What is H2C Club?</h2>
                        <p>H2C Club is a social community platform, a place where we can help each other, and spread kindness throughout the world so that we can create mutual prosperity.</p>
                    </div>
                </div>
            </div>


            <div class="section-content bg-light p-4">
                <div class="row justify-content-center text-center">
                    <div class="col-sm-7 col-md-6 col-9">
                        <div class="section-head">
                            <h2 class="title">How does H2C Club work?</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center text-center g-gs">
                    <div class="col-9 col-sm-7 col-md-4">
                        <div class="service service-s2">
                            <img src="{{ asset('landing/images/star.png') }}" class="w-50 mb-4">
                            <div class="service-text">
                                <h4 class="title">Membership</h4>
                                <p>Everyone can join to be part of the H2C Club Donor.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 col-sm-7 col-md-4">
                        <div class="service service-s2">
                            <img src="{{ asset('landing/images/star.png') }}" class="w-50 mb-4">
                            <div class="service-text">
                                <h4 class="title">Daily Blessing</h4>
                                <p>Every Donor who makes a donation will get a Daily Blessing in the amount according to the donation package they have.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 col-sm-7 col-md-4">
                        <div class="service service-s2">
                            <img src="{{ asset('landing/images/star.png') }}" class="w-50 mb-4">
                            <div class="service-text">
                                <h4 class="title">Prosperity Blessing</h4>
                                <p>Every Donor who makes a donation will also get a Prosperity Blessing if the Kindness Meter donation has reached 100%.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- <section class="section section-feature pb-0" id="feature">
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
    </section> --}}

    <section class="section section-cta">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title">Social Event</h2>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row align-items-center justify-content-between">
                <div>
                    <img class="object-fit-cover" src="{{ asset('landing/images/img01.jpeg') }}" alt="">
                </div>
                <div>
                    <img class="object-fit-cover" src="{{ asset('landing/images/img02.jpeg') }}" alt="">
                </div>
                <div>
                    <img class="object-fit-cover" src="{{ asset('landing/images/img03.jpeg') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="section section-cta mt-2">
        <div class="container  bg-light py-4">
            <div class="row justify-content-center text-center">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="text-block is-compact">
                        <h2 class="title">Get Started with H2C Club</h2>
                        <p class="lead">Spread kindness to the world and bring prosperity to all</p>
                        <ul class="btns-inline justify-center">
                            <li>
                                <a href="{{ route('dashboard') }}" class="btn btn-xl btn-primary">Join</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
