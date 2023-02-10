@extends('layouts.landing')

@section('content')
<section class="section section-cta is-dark" id="cta">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-9 col-md-10">
                <div class="text-block is-compact py-3">
                    <h2 class="title">H2C Club Backgroud</h2>
                    <p>Currently, when all countries in the world are experiencing an economic recession, so many new poverty problems have arisen. Without a helping hand and help from all of us, the situation will get worse. So it's time for all of us to be together with the H2C Club to be able to help others and create prosperity together.</p>
                    <ul class="header-action btns-inline">
                        <li><a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg btn-round"><span>Join Us!</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-image bg-overlay after-bg-dark after-opacity-90">
        <img src="{{ asset('/landing/new_image/about-us1-min.png') }}" alt="">
    </div>
</section>

<section class="section section-pricing" id="pricing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-head text-center">
                    <h2 class="title">Choose Best Plan For You</h2>
                    <p>Spread kindness to the world and bring prosperity to all.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center justify-content-lg-between align-items-center g-gs">
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon" src="{{ asset('/landing/new_image/icon_packages-01-new-min.png') }}" alt="">
                        <h2 class="pricing-amount text-purple">$130</h2>
                        <h5 class="pricing-title">Regular</h5>
                        <span class="sub-title">3 generation kindness meter</span>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Donation : $100</li>
                            <li>Joining Fee : $10</li>
                            <li>Daily Blessing : $0.135/day</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon" src="{{ asset('/landing/new_image/icon_packages-02-new-min.png') }}" alt="">
                        <h2 class="pricing-anount text-purple">$1,300</h2>
                        <h5 class="pricing-title">Advance</h5>
                        <span class="sub-title">5 generation kindness meter</span>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Donation : $1,000</li>
                            <li>Joining Fee : $100</li>
                            <li>Daily Blessing : $8.5/day</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon" src="{{ asset('/landing/new_image/icon_packages-03-new-min.png') }}" alt="">
                        <h2 class="pricing-anount text-purple">$12,750</h2>
                        <h5 class="pricing-title">Premium</h5>
                        <span class="sub-title">7 generation kindness meter</span>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Donation : $10,000</li>
                            <li>Joining Fee : $750</li>
                            <li>Daily Blessing : $22.5/day</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon" src="{{ asset('/landing/new_image/icon_packages-04-new-min.png') }}" alt="">
                        <div class="pricing-badge">Popular</div>
                        <h2 class="pricing-anount text-purple">$125,000</h2>
                        <h5 class="pricing-title">Solitaire</h5>
                        <span class="sub-title">9 generation kindness meter</span>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Donation : $100,000</li>
                            <li>Joining Fee : $5000</li>
                            <li>Daily Blessing : $275/day</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="margin-bottom: 70px;" class="pb-0" id="package">
    <div class="container">
        <div class="row justify-content-center text-tenter">
            <div class="col-xl-7 col-lg-9">
                <div class="section-head text-center mb-1">
                    <h2 class="title text-dark mb-0">Donation Packages Rules</h2>
                    <p>Spread kindness to the world and bring prosperity to all.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="row align-items-center g-0">
                    <div class="col-md-7">
                        <div class="card card-shadow round-xl bg-dark is-dark pb-4 pb-md-0">
                            <div class="card-inner card-inner-xl">
                                <div class="text-block">
                                    <ul class="list list-nostyle fs-15px mb-1">
                                        <li>Each donor can only have 1 active donation package </br> for each type</li>
                                        <li>Donation deposit rate : 1,2 USDT/USD</li>
                                        <li>Donation withdrawal rate : 1 USDT/USD</li>
                                        <li>Withdrawal minimum : $25/withdrawal</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-shadow card-bd-right-3px round-xl ms-lg-n7 ms-md-n5 mx-4 me-md-0 mt-md-0 mt-n4">
                            <div class="card-inner card-inner-lg">
                                <div class="text-block is-compact pe-3">
                                    <ul class="list list-nostyle fs-15px">
                                        <li>Management fee rate : 1 USDT/USD applies to deposit and withdrawal</li>
                                        <li>The rate difference will be distributed to all active donors according to their donation rating</li>
                                        <li>Daily Blessing will be received every day forever or until you reach Prosperity Blessing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <h2 class="title">Kindness Meter</h2>
                    <ul class="list list-lg list-purple list-checked-circle gy-4">
                        <p>Kindness Meter is a meter that shows Prosperity achievement Blessing.</p>
                        <p>A donor's Kindness meter will increase when available donors in his network who make the appropriate new donation with this type of kindness meter.</p>
                        <p>Kindness Meter will be processed once a day.</p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-image bg-overlay after-bg-dark after-opacity-90">
        <img src="{{ asset('/landing/new_image/about-us2-min.png') }}" alt="">
    </div>
</section>

<section class="section section-pricing" id="pricing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-head text-center">
                    <h2 class="title">Kindness Meter Tables</h2>
                    <p>Spread kindness to the world and bring prosperity to all.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center justify-content-lg-between align-items-center g-gs">
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon2" src="{{ asset('/landing/new_image/icon_packages-01-new-min.png') }}" alt="">
                        <h5 class="pricing-title">Regular</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Generation 1 : 10%</li>
                            <li>Generation 2 : 5%</li>
                            <li>Generation 3 : 3%</li>
                            <li>Generation 4 : -</li>
                            <li>Generation 5 : -</li>
                            <li>Generation 6 : -</li>
                            <li>Generation 7 : -</li>
                            <li>Generation 8 : -</li>
                            <li>Generation 9 : -</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon2" src="{{ asset('/landing/new_image/icon_packages-02-new-min.png') }}" alt="">
                        <h5 class="pricing-title">Advance</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Generation 1 : 10%</li>
                            <li>Generation 2 : 5%</li>
                            <li>Generation 3 : 3%</li>
                            <li>Generation 4 : 2%</li>
                            <li>Generation 5 : 1%</li>
                            <li>Generation 6 : -</li>
                            <li>Generation 7 : -</li>
                            <li>Generation 8 : -</li>
                            <li>Generation 9 : -</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon2" src="{{ asset('/landing/new_image/icon_packages-03-new-min.png') }}" alt="">
                        <h5 class="pricing-title">Premium</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Generation 1 : 10%</li>
                            <li>Generation 2 : 5%</li>
                            <li>Generation 3 : 3%</li>
                            <li>Generation 4 : 2%</li>
                            <li>Generation 5 : 1%</li>
                            <li>Generation 6 : 1%</li>
                            <li>Generation 7 : 1%</li>
                            <li>Generation 8 : -</li>
                            <li>Generation 9 : -</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-160px package-icon2" src="{{ asset('/landing/new_image/icon_packages-04-new-min.png') }}" alt="">
                        <h5 class="pricing-title">Solitaire</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>Generation 1 : 10%</li>
                            <li>Generation 2 : 5%</li>
                            <li>Generation 3 : 3%</li>
                            <li>Generation 4 : 2%</li>
                            <li>Generation 5 : 1%</li>
                            <li>Generation 6 : 1%</li>
                            <li>Generation 7 : 1%</li>
                            <li>Generation 8 : 1%</li>
                            <li>Generation 9 : 1%</li>
                        </ul>
                    </div>
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
                    <h2 class="title">Donation Rank</h2>
                    <ul class="list list-lg list-purple list-checked-circle gy-4">
                        <p>Donation Rank is the total accumulation of donations from all teams which will be reset and reduced by the need to achieve a rank when the rank is reached.</p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-image bg-overlay after-bg-dark after-opacity-90">
        <img src="{{ asset('/landing/new_image/about-us4-min.png') }}" alt="">
    </div>
</section>

<section class="section section-pricing" id="pricing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-head text-center">
                    <h2 class="title">Donation Rank Tables</h2>
                    <p>Spread kindness to the world and bring prosperity to all.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center justify-content-lg-between align-items-center g-gs">
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-06-min.png') }}" alt="">
                        <img class="h-160px donation-icon" src="{{ asset('/landing/new_image/icon_packages-06-min.png') }}" alt="">
                        <h5 class="pricing-title">Donator</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li><span>Direct Donator :</span> 3</li>
                            <li><span>Must Have :</span> -</li>
                            <li><span>Team Donator :</span> 10</li>
                            <li><span>Donation Total :</span> $10,000</li>
                            <li><span>Reward :</span> $250</li>
                            <li><span>Social Event :</span> $0</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-07-min.png') }}" alt="">
                        <img class="h-160px donation-icon" src="{{ asset('/landing/new_image/icon_packages-07-min.png') }}" alt="">
                        <h5 class="pricing-title">Coordinator</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li><span>Donator :</span> 5</li>
                            <li><span>Must Have :</span> 8 donators</li>
                            <li><span>Team Donator :</span> 100</li>
                            <li><span>Donation Total :</span> $100,000</li>
                            <li><span>Reward :</span> $2,500</li>
                            <li><span>Social Event :</span> $500</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-08-min.png') }}" alt="">
                        <img class="h-160px donation-icon" src="{{ asset('/landing/new_image/icon_packages-08-min.png') }}" alt="">
                        <h5 class="pricing-title">Supervisor</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li><span>Direct Donator :</span> 10</li>
                            <li><span>Must Have :</span> 8 coordinators</li>
                            <li><span>Team Donator :</span> 1000</li>
                            <li><span>Donation Total :</span> $900,000</li>
                            <li><span>Reward :</span> $22,500</li>
                            <li><span>Social Event :</span> $4,500</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-09-min.png') }}" alt="">
                        <img class="h-160px donation-icon" src="{{ asset('/landing/new_image/icon_packages-09-min.png') }}" alt="">
                        <h5 class="pricing-title">Manager</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li><span>Direct Donator :</span> 15</li>
                            <li><span>Must Have :</span> 4 supervisors</li>
                            <li><span>Team Donator :</span> 10,000</li>
                            <li><span>Donation Total :</span> $7,500,000</li>
                            <li><span>Reward :</span> $187,500</li>
                            <li><span>Social Event :</span> $37,500</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-10-min.png') }}" alt="">
                        <img class="h-160px donation-icon" src="{{ asset('/landing/new_image/icon_packages-10-min.png') }}" alt="">
                        <h5 class="pricing-title">Director</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li><span>Direct Donator :</span> 20</li>
                            <li><span>Must Have :</span> 2 managers</li>
                            <li><span>Team Donator :</span> 100,000</li>
                            <li><span>Donation Total :</span> $50,000,000</li>
                            <li><span>Reward :</span> $1,250,000</li>
                            <li><span>Social Event :</span> $250,000</li>
                        </ul>
                    </div>
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
                    <h2 class="title">Rate Difference</h2>
                    <ul class="list list-lg list-purple list-checked-circle gy-4">
                        <p>The difference in rate will be distributed to all donors who have met the requirements, the amount according to their respective ratings.</p>
                        <p>The rate difference is intended so that donors can get a fee for spreading the H2C Club concept and kindness around the world.</p>
                        <p>The difference in rate applies to breakaway if there are other donors below who have the same or higher rating.</p>
                        <p>The distribution of the difference in rate will apply automatically and will enter the donor's wallet balance every day.</p>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-image bg-overlay after-bg-dark after-opacity-90">
        <img src="{{ asset('/landing/new_image/about-us3-min.png') }}" alt="">
    </div>
</section>

<section class="section section-pricing" id="pricing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-head text-center">
                    <h2 class="title">Rate Difference Tables</h2>
                    <p>Spread kindness to the world and bring prosperity to all.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center justify-content-lg-between align-items-center g-gs">
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-06-min.png') }}" alt="">
                        <h5 class="pricing-title">Donator</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>$0.05 USDT/USD</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-07-min.png') }}" alt="">
                        <h5 class="pricing-title">Coordinator</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>$0.75 USDT/USD</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-08-min.png') }}" alt="">
                        <h5 class="pricing-title">Supervisor</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>$0.10 USDT/USD</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-09-min.png') }}" alt="">
                        <h5 class="pricing-title">Manager</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>$0.125 USDT/USD</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-xxx col-sm-6">
                <div class="pricing pricing-s2 card card-shadow round-md">
                    <div class="card-inner card-inner-lg">
                        <img class="h-60px" src="{{ asset('/landing/new_image/icon_packages-10-min.png') }}" alt="">
                        <h5 class="pricing-title">Director</h5>
                        <hr class="hr border-light">
                        <ul class="pricing-feature list list-nostyle">
                            <li>$0.15 USDT/USD</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-cta text-light py-0 aboutus-lastsection" id="cta">
    <div class="container">
        <div class="card bg-dark bg-grad-c">
            <div class="card-inner p-5">
                <div class="row justify-content-between align-items-center g-gs">
                    <div class="col-lg-8">
                        <div class="text-block">
                            <h3 class="title text-light">Get Started with H2C Club</h3>
                            <p>Spread kindness to the world and bring prosperity to all.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-lg-end">
                        <a href="#" class="btn btn-primary btn-round btn-lg">Join Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
