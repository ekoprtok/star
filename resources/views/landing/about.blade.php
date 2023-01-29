@extends('layouts.landing')

@section('content')

    <section class="section section-service pb-0" id="service">
        <div class="container">
            <div class="row justify-content-center text-center my-5 bg-light p-4">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title">H2C Club Background</h2>
                        <p>
                            Currently, when all countries in the world are experiencing an economic recession, so many new poverty problems have arisen.
                            Without a helping hand and help from all of us, the situation will get worse.
                            So it's time for all of us to be together with the H2C Club to be able to help others and create prosperity together.
                        </p>
                    </div>
                </div>
            </div>


            <div class="section-content">
                <div class="row justify-content-center text-center">
                    <div class="col-sm-7 col-md-6 col-9">
                        <div class="section-head">
                            <h2 class="title">Donation Packages</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-gs">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Regular
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Advance
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Premium
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Solitaire
                                </th>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Package</td>
                                <td>$110</td>
                                <td>$1.100</td>
                                <td>$10.750</td>
                                <td>$105.000</td>
                            </tr>
                            <tr>
                                <td>Donation</td>
                                <td>$100</td>
                                <td>$1.000</td>
                                <td>$10.000</td>
                                <td>$100.000</td>
                            </tr>
                            <tr>
                                <td>Management Fee</td>
                                <td>$10</td>
                                <td>$100</td>
                                <td>$1.000</td>
                                <td>$10.000</td>
                            </tr>
                            <tr>
                                <td>Daily Blessing</td>
                                <td>$0,135/day</td>
                                <td>$1,75/day</td>
                                <td>$22,5/day</td>
                                <td>$275/day</td>
                            </tr>
                            <tr>
                                <td>Kindness Meter</td>
                                <td>3 Generations</td>
                                <td>5 Generations</td>
                                <td>7 Generations</td>
                                <td>9 Generations</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row justify-content-center my-5 bg-light p-4">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title text-center">Donation Packages Rules</h2>
                    </div>
                    <ul class="cstom">
                        <li>Each donor can only have 1 active donation package for each type.</li>
                        <li>Donation deposit rate : 1,2 USDT/USD.</li>
                        <li>Donation withdrawal rate : 1 USDT/USD.</li>
                        <li>Withdrawal minimum : $25/withdrawal.</li>
                        <li>Management fee rate : 1 USDT/USD applies to deposit and withdrawal.</li>
                        <li>The rate difference will be distributed to all active donors according to their donation rating.</li>
                        <li>Daily Blessing will be received every day forever or until you reach Prosperity Blessing.</li>
                    </ul>
                </div>
            </div>

            <div class="row justify-content-center my-5 p-4">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title text-center">Kindness Meter</h2>
                    </div>
                    <ul class="cstom">
                        <li>Kindness Meter is a meter that shows Prosperity achievement Blessing.</li>
                        <li>
                            A donor's Kindness meter will increase when available donors in his network who make the appropriate new donation with this type of kindness meter.
                            </li>
                        <li>Kindness meter akan di settle 1x per hari.</li>
                    </ul>
                </div>
            </div>

            <div class="row justify-content-center g-gs">
                <div class="section-head">
                    <h2 class="title text-center">Kindness Meter Table</h2>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                Regular
                            </th>
                            <th>
                                <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                Advance
                            </th>
                            <th>
                                <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                Premium
                            </th>
                            <th>
                                <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                Solitaire
                            </th>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Generation 1</td>
                            <td>10%</td>
                            <td>10%</td>
                            <td>10%</td>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <td>Generation 2</td>
                            <td>5%</td>
                            <td>5%</td>
                            <td>5%</td>
                            <td>5%</td>
                        </tr>
                        <tr>
                            <td>Generation 3</td>
                            <td>3%</td>
                            <td>3%</td>
                            <td>3%</td>
                            <td>3%</td>
                        </tr>
                        <tr>
                            <td>Generation 4</td>
                            <td>-</td>
                            <td>2%</td>
                            <td>2%</td>
                            <td>2%</td>
                        </tr>
                        <tr>
                            <td>Generation 5</td>
                            <td>-</td>
                            <td>1%</td>
                            <td>1%</td>
                            <td>1%</td>
                        </tr>
                        <tr>
                            <td>Generation 6</td>
                            <td>-</td>
                            <td>-</td>
                            <td>1%</td>
                            <td>1%</td>
                        </tr>
                        <tr>
                            <td>Generation 7</td>
                            <td>-</td>
                            <td>-</td>
                            <td>1%</td>
                            <td>1%</td>
                        </tr>
                        <tr>
                            <td>Generation 8</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>1%</td>
                        </tr>
                        <tr>
                            <td>Generation 9</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>1%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-center text-center my-5 p-4">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title text-center">Donation Rank</h2>
                    </div>
                    <p>Donation Rank is the total accumulation of donations from all teams which will be reset and reduced by the need to achieve a rank when the rank is reached.</p>
                </div>
            </div>

            <div class="section-content">
                <div class="row justify-content-center text-center">
                    <div class="col-sm-7 col-md-6 col-9">
                        <div class="section-head">
                            <h2 class="title">Donation Rank Table</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-gs">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Donator
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Coordinator
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Supervisor
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Manager
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Director
                                </th>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Direct Donator</td>
                                <td>3</td>
                                <td>5</td>
                                <td>10</td>
                                <td>15</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Must Have</td>
                                <td>-</td>
                                <td>8 donators</td>
                                <td>6 coordinators</td>
                                <td>4 supervisors</td>
                                <td>2 managers</td>
                            </tr>
                            <tr>
                                <td>Team Donator Total</td>
                                <td>10</td>
                                <td>100</td>
                                <td>1.000</td>
                                <td>10.000</td>
                                <td>100.000</td>
                            </tr>
                            <tr>
                                <td>Donation Total</td>
                                <td>$10.000</td>
                                <td>$100.000</td>
                                <td>$900.000</td>
                                <td>$7.500.000</td>
                                <td>$50.000.000</td>
                            </tr>
                            <tr>
                                <td>Reward</td>
                                <td>$250</td>
                                <td>$2.500</td>
                                <td>$22.500</td>
                                <td>$187.500</td>
                                <td>$1.250.000</td>
                            </tr>
                            <tr>
                                <td>Social Event</td>
                                <td>-</td>
                                <td>$500</td>
                                <td>$4.500</td>
                                <td>$37.500</td>
                                <td>$250.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row justify-content-center my-5 p-4">
                <div class="col-sm-7 col-md-6 col-9">
                    <div class="section-head">
                        <h2 class="title text-center">Rate Diffference</h2>
                    </div>
                    <ul class="cstom">
                        <li>The difference in rate will be distributed to all donors who have met the requirements, the amount according to their respective ratings.</li>
                        <li>The rate difference is intended so that donors can get a fee for spreading the H2C Club concept and kindness around the world.</li>
                        <li>The difference in rate applies to breakaway if there are other donors below who have the same or higher rating.</li>
                        <li>The distribution of the difference in rate will apply automatically and will enter the donor's wallet balance every day.</li>
                    </ul>
                </div>
            </div>

            <div class="section-content">
                <div class="row justify-content-center text-center">
                    <div class="col-sm-7 col-md-6 col-9">
                        <div class="section-head">
                            <h2 class="title">Rate Diffference Table</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-gs">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Donator
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Coordinator
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Supervisor
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Manager
                                </th>
                                <th>
                                    <img src="{{ asset('landing/images/star.png') }}" class="w-25"><br><br>
                                    Director
                                </th>
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rate Difference</td>
                                <td>$0,05 USDT/USD</td>
                                <td>$0,75 USDT/USD</td>
                                <td>$0,1 USDT/USD</td>
                                <td>$0,125 USDT/USD</td>
                                <td>$0,15 USDT/USD</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-cta">
        <div class="container">
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
