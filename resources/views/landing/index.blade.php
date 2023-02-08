@extends('layouts.landing')

@section('content')
    <section class="section section-service py-0" id="service">
        <div class="container">
            <div class="section-content">
                <div class="row justify-content-start text-start g-gs">
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-shadow">
                            <div class="card-inner card-inner-lg">
                                <div class="service">
                                    <div class="service-icon styled-icon styled-icon-6x text-primary">
                                        <img class="h-60px" src="{{ asset('/landing/new_image/members-min.png') }}" alt="">
                                    </div>
                                    <div class="service-text">
                                        <h4 class="title">Membership</h4>
                                        <p>Everyone can join to be part of the H2C Club Donor.</br></br></br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-shadow">
                            <div class="card-inner card-inner-lg">
                                <div class="service">
                                    <div class="service-icon styled-icon styled-icon-6x text-primary">
                                        <img class="h-60px" src="{{ asset('/landing/new_image/give-love-min.png') }}" alt="">
                                    </div>
                                    <div class="service-text">
                                        <h4 class="title">Daily Blessing</h4>
                                        <p>Every Donor who makes a donation will get a Daily Blessing in the amount according to the donation package they have.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="card card-shadow">
                            <div class="card-inner card-inner-lg">
                                <div class="service">
                                    <div class="service-icon styled-icon styled-icon-6x text-primary">
                                        <img class="h-60px" src="{{ asset('/landing/new_image/speedometer-min.png') }}" alt="">
                                    </div>
                                    <div class="service-text">
                                        <h4 class="title">Prosperity Blessing</h4>
                                        <p>Every Donor who makes a donation will also get a Prosperity Blessing if the Kindness Meter donation has reached 100%.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-product" id="product">
        <div class="container">
            <div class="row justify-content-center text-tenter">
                <div class="col-lg-7">
                    <div class="section-head text-center">
                        <div class="section-head">
                            <h2 class="title">What is H2C Club?</h2>
                        </div>
                        <p>H2C Club is a social community platform, a place where we can help each other, and spread
                            kindness throughout the world so that we can create mutual prosperity.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section section-cta is-dark" id="cta">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-9 col-md-10">
                    <div class="text-block is-compact py-3">
                        <div class="section-head">
                            <h2 class="title">Social Events</h2>
                        </div>
                        <p>Spread kindness to the world and bring prosperity to all.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-image bg-overlay after-bg-dark after-opacity-90">
            <img src="{{ asset('/landing/new_image/social-events-min.png') }}" alt="">
        </div>
    </section>

    <section class="section section-testimonial pb-0" id="reviews">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-7 col-md-8 col-10">
                    <div class="section-head">
                        <h2 class="title">This is what our esteemed members have to say for us</h2>
                    </div>
                </div>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators data-indi">

                </div>
                <div class="carousel-inner data-caro">

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    <section class="section section-cta">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="text-block is-compact">
                        <div class="img-block h-150px mb-4">
                            <img class="h-100px" src="{{ asset('/landing/new_image/give-love-min.png') }}"
                                alt="">
                        </div>
                        <h2 class="title">Get Started with H2C Club</h2>
                        <p class="lead">Spread kindness to the world and bring prosperity to all.</p>
                        <ul class="btns-inline justify-center">
                            <li>
                                <a href="{{ route('dashboard') }}" target="_blank" class="btn btn-primary btn-xl btn-round">Join Us!</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
<script>
    $.ajax({
        url : '{{ route('landing.testimoni') }}',
        dataType : 'jSON',
        success : function(r) {
            let content   = '';
            let indicator = '';
            if (r.length > 0) {
                r.map((item, index) => {
                    content += `
                        <div class="carousel-item p-5 ${index == 0 ? 'active' : ''} mh-50">
                            <div class="row g-gs justify-content-center">
                                <div class="col-lg-6">
                                    <div class="card card-shadow round-xl">
                                        <div class="card-inner card-inner-lg">
                                            <div class="review review-s2">
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
                                                        <p>${item.file_path}</p>
                                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                                            <h6 class="review-name text-dark"></h6>
                                                            <a class="love" href="javascript:void(0);" onclick="love('${item.id}')">
                                                                <i class="fs-5 bi bi-heart bi-${item.id}"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    indicator += `<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${index}" class="${index == 0 ? 'active' : ''}" aria-current="true" aria-label="Slide 1"></button>`;
                });
            }

            $('.data-caro').append(content);
            $('.data-indi').append(indicator);
        }
    });

    function love(id) {
        $('.bi-'+id).removeClass('bi bi-heart').addClass('bi bi-heart-fill');
    }
</script>
@endpush
