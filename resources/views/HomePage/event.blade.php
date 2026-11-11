@extends('layouts.webSite')
@section('title', 'Our Destinations')
@section('content')
<div class="information-page-slider">
    <img src="./assets/img/travel-bg.jpg" alt="Home Stylers" class="img-fluid">
    <div class="information-content">
        <ul class="m-auto list-unstyled custom-container">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="javascript:void(0);">Our destinations</a></li>
        </ul>
    </div>
</div>
<div id="about">
    <div class="default-content pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center"> Our destinations</h2>
                <p class="text-center pb-3">believes in helping its customers as far as possible, and has therefore a liberal cancellation policy. Under this policy:</p>
            </div>
            <div class="service-icon-content">
                <div class="icon-content">
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-1.png" alt=""></div>
                        <p class="text-center">Flight</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-2.png" alt=""></div>
                        <p class="text-center">Hotel</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-3.png" alt=""></div>
                        <p class="text-center">Cab</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-4.png" alt=""></div>
                        <p class="text-center">Train</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-5.png" alt=""></div>
                        <p class="text-center">Bus</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-6.png" alt=""></div>
                        <p class="text-center">Package</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-7.png" alt=""></div>
                        <p class="text-center">Visa</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/img/service-8.png" alt=""></div>
                        <p class="text-center">Passport</p>
                    </div>
                </div>
            </div>

            <div class="package-tabs">
                <div class="domastic-section mt-5 mb-4" id="Domestic_Packages">
                    <div class="site-title pb-3">
                        <h2>Domestic <span>Packages</span></h2>
                    </div>
                    <div class="row">
                        @if (isset($getPackages["Domestic"])&& count($getPackages["Domestic"]))
                            @foreach ($getPackages["Domestic"] as $pack)
                            <div class="col-12  col-sm-6 col-md-4 col-lg-3" >
                                @include("HomePage.HomePageParts.packsView")
                            </div>
                                
                            @endforeach
                            @else
                            <span>Sorry no packs found</span>
                        @endif
                    </div>
                </div>
                <div class="interbational-section mt-5 mb-4" id="International_Packages">
                    <div class="site-title pb-3">
                        <h2>International <span>Packages</span></h2>
                    </div>
                    <div class="row">
                        @if (isset($getPackages["International"])&& count($getPackages["International"]))
                            @foreach ($getPackages["International"] as $pack)
                            <div class="col-12  col-sm-6 col-md-4 col-lg-3" >
                                @include("HomePage.HomePageParts.packsView")
                            </div>
                            @endforeach
                            @else
                            <span>Sorry no packs found</span>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection