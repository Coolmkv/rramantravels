@extends('layouts.webSite')
@section('title', "odisha voyages ")
@section('meta_description', "odisha voyages")
@section('meta_keywords', "odisha voyages")
@section('content')
<style>
     
       h2 {
            font-size: 3.5rem;
            font-weight: 700;
         background: linear-gradient(45deg, #ff9933, #b22222, #1e3c72, #228b22);
   background-size: 300% 300%;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 4s ease-in-out infinite;
            margin-bottom: 20px;
            position: relative;
        }

         h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, transparent, #ff6b8a, transparent);
            border-radius: 2px;
            animation: underlineGlow 2s ease-in-out infinite alternate;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes underlineGlow {
            from { box-shadow: 0 0 5px #ff6b6b; }
            to { box-shadow: 0 0 20px #ff6b6b, 0 0 30px #ff6b6b; }
        }
</style>


    <!-- Destination Gallery start -->
    <div class="destination-gallery pt-100 pt-120">
    <div class="blog-banner" style="margin-bottom:50px;">
  <img src="./assets/images/odisha.jpeg" style="max-height:200px;width:100%" alt=""> 
      </div>

    <div class="container-fluid">
        <div class="row gap-10 justify-content-center rel">
            @php
                $images = is_string($activities->activity_image)
                    ? json_decode($activities->activity_image, true)
                    : $activities->activity_image;
                $images = is_array($images) ? $images : [];
            @endphp

            {{-- First column (index 0 and 3) --}}
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item fixed-image-size">
                    @if(isset($images[0]))
                        <img src="{{ asset('storage/' . $images[0]) }}" alt="{{ $activities->activity_name }}" class="img-fluid">
                    @else
                        <img src="./assets/images/destination-details1.jpg" alt="Placeholder" class="img-fluid fixed-image-size">
                    @endif

                    @if(isset($images[3]))
                        <img src="{{ asset('storage/' . $images[3]) }}" alt="{{ $activities->activity_name }}" class="img-fluid">
                    @else
                        <img src="./assets/images/destination-details4.jpg" alt="Placeholder" class="img-fluid fixed-image-size">
                    @endif
                </div>
            </div>

            {{-- Second column (index 1) --}}
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item unique-image-size">
                    @if(isset($images[1]))
                        <img src="{{ asset('storage/' . $images[1]) }}" alt="{{ $activities->activity_name }}" class="img-fluid">
                    @else
                        <img src="./assets/images/destination-details2.jpg" alt="Placeholder" class="img-fluid unique-image-size">
                    @endif
                </div>
            </div>

            {{-- Third column (index 2 and 4) --}}
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item fixed-image-size below-image">
                    @if(isset($images[2]))
                        <img src="{{ asset('storage/' . $images[2]) }}" alt="{{ $activities->activity_name }}" class="img-fluid">
                    @endif

                    @if(isset($images[4]))
                        <img src="{{ asset('storage/' . $images[4]) }}" alt="{{ $activities->activity_name }}" class="img-fluid">
                    @else
                        <img src="./assets/images/destination-details5.jpg" alt="Placeholder" class="img-fluid fixed-image-size">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Destination Gallery End -->


    <!-- About Us Area start -->
    <section class="about-us-area pt-90 pb-100 rel z-1">
    <div class="container">
        <div class="row gap-100 align-items-center">
            {{-- Left Content --}}
            <div class="col-lg-6">
                <div class="destination-details-content rmb-55" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="section-title mb-25">
                        <span class="h2 mb-15">Welcome to </span>
                        <h2>{{ $activities->activity_name }}</h2>
                    </div>
                    <p>
                        {!! $activities->activity_details !!}
                    </p>
                    <a href="{{ route('activitiespage') }}" class="theme-btn mt-25 style-two">
                        <span data-hover="Explore Activities">Explore Activities</span>
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Right Content (Map / Optional) --}}
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                <div class="destination-map">
                   
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3742.1397193443945!2d85.81330919!3d20.2944831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19090aba25ac3b%3A0x60fce4144916546f!2sCookies%20IRC%20VILLAGE!5e0!3m2!1sen!2sin!4v1756291110040!5m2!1sen!2sin "
                            style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
    
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- About Us Area end -->
<!-- Destinations Area start -->
<section class="destinations-area bgc-black pt-100 pb-70 rel z-1">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2 class="popular-destination" data-aos="fade-up">Packages with {{ $activities->activity_name }}</h2>
                    <p>Discover experiences that include <strong>{{ $activities->activity_name }}</strong></p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="swiper packages mt-4">
                <div class="swiper-wrapper">
                    @forelse ($packages as $item)
                        @php
                            $images = is_string($item->package_image)
                                ? json_decode($item->package_image, true)
                                : $item->package_image;
                            $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                        @endphp

                        <div class="col-xxl-3 col-xl-4 col-md-6 swiper-slide">
                            <a href="{{ route('tourDetailpage', ['slug' => $item->slug]) }}">
                                <div class="destination-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                    <div class="image">
                                        @if ($displayImage)
                                            <img src="{{ asset('storage/' . $displayImage) }}" 
                                                 alt="{{ $item->package_name }}" 
                                                 class="gallery-image">
                                        @else
                                            <img src="{{ asset('assets/images/default-package.jpg') }}" 
                                                 alt="Default Image">
                                        @endif
                                        <div class="ratting">{{ $item->package_type }}</div>
                                    </div>
                                    <div class="content tourpackage">
                                        <h5 class="card-heading">{!! $item->package_name !!}</h5>
                                        <span class="time">
                                            {!! $item->package_duration_days !!} Days / 
                                            {!! $item->package_duration_nights !!} Nights
                                        </span>
                                    </div>
                                    <div class="destination-footer price">
                                        <span class="offer-price">
                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                            {!! IND_money_format($item->package_offer_price) !!}
                                        </span>
                                        <span class="sale-price">
                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                            {!! IND_money_format($item->package_price) !!}
                                        </span>
                                        <span class="offer-amount">
                                            Save <i class="fa-solid fa-indian-rupee-sign"></i>
                                            {{ IND_money_format($item->package_price - $item->package_offer_price) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <span class="text-white">No Packages found with {{ $activities->activity_name }}.</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>


{{-- <section class="activities-area bgc-black pt-100 pb-70 rel z-1">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2 class="popular-activities" data-aos="fade-up">
Our Attractions
                    </h2>
                    <p>Activities available in packages for this destination</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="swiper activities mt-4">
                <div class="swiper-wrapper">
                    @forelse ($activities as $activity)
                        <div class="col-xxl-3 col-xl-4 col-md-6 swiper-slide">
                            <a href="{{ route('activitiesDetailpage', ['slug' => $activity->slug]) }}">
                                <div class="destination-item activity-card" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                    <div class="image">
                                        @php
                                            $images = is_string($activity->activity_image) 
                                                ? json_decode($activity->activity_image, true) 
                                                : $activity->activity_image;
                                            $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                                        @endphp

                                        @if ($displayImage)
                                            <img src="{{ asset('storage/' . $displayImage) }}" 
                                                 alt="{{ $activity->activity_name }}" 
                                                 class="gallery-image">
                                        @else
                                            <img src="{{ asset('assets/images/default-activity.jpg') }}" 
                                                 alt="Default Activity">
                                        @endif
                                    </div>
                                    <div class="content text-center tourpackage mt-3">
                                        <h5 class="card-heading">{{ $activity->activity_name }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <span class="text-white">
                            No Activities found for {{ $destination->destination_name }}.
                        </span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section> --}}


<style>
  .activity-card {
    border-radius: 10px;
    overflow: hidden;
    background: #1a1a1a;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.activity-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

.activity-card .image {
    width: 100%;
    height: 200px; /* fixed height */
    overflow: hidden;
}

.activity-card .image img {
    width: 100%;
    height: 100%; /* match container height */
    object-fit: cover; /* ensures the image covers without stretching */
    display: block;
}

.activity-card .content h5 {
    color: #fff;
    font-size: 1.2rem;
    text-align: center;
    margin: 10px 0;
}

</style>





<!-- Destinations Area end -->

    <!-- Destinations Area start -->
    <!-- <section class="destinations-area bgc-lighter pt-85 pb-100 rel z-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up"
                        data-aos-duration="1500" data-aos-offset="50">
                        <h2>Explore Our Popular Destinations</h2>
                        <p>One site many popular
                            experience you’ll remember</p>
                    </div>
                </div>
            </div>
            {{-- <div class="destination-active">
                <div class="destination-item style-two" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <img src="./assets/images/destination-five1.jpg" alt="Destination">
                    </div>
                    <div class="contents">
                        <h6><a>Switzerland's</a></h6>
                        <span class="destination-details.htmlours">258 tours</span>
                    </div>
                </div>
                <div class="destination-item style-two" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <img src="./assets/images/destination-five2.jpg" alt="Destination">
                    </div>
                    <div class="contents">
                        <h6><a href="#">Poland</a></h6>
                        <span class="tours">258 tours</span>
                    </div>
                </div>
                <div class="destination-item style-two" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <img src="./assets/images/destination-five3.jpg" alt="Destination">
                    </div>
                    <div class="contents">
                        <h6><a href="#">Indonesia</a></h6>
                        <span class="tours">258 tours</span>
                    </div>
                </div>
                <div class="destination-item style-two" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <img src="./assets/images/destination-five4.jpg" alt="Destination">
                    </div>
                    <div class="contents">
                        <h6><a href="#">Thailand</a></h6>
                        <span class="tours">258 tours</span>
                    </div>
                </div>
                <div class="destination-item style-two" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <img src="./assets/images/destination-five5.jpg" alt="Destination">
                    </div>
                    <div class="contents">
                        <h6><a href="#">Rome, Italy</a></h6>
                        <span class="tours">258 tours</span>
                    </div>
                </div>
                <div class="destination-item style-two" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <img src="./assets/images/destination-five2.jpg" alt="Destination">
                    </div>
                    <div class="contents">
                        <h6><a href="#">Indonesia</a></h6>
                        <span class="tours">258 tours</span>
                    </div>
                </div>
            </div> --}}
            <div class="destination-active">
                @if (isset($homedestinations) && count($homedestinations) > 0)
                    @foreach ($homedestinations as $package)
                        @php
                            // Ensure package_image is decoded if it's a JSON string
                            $images = is_string($package->destination_image)
                                ? json_decode($package->destination_image, true)
                                : $package->destination_image;
            
                            // Use the first image if available; otherwise, set a default image
                            $displayImage = is_array($images) && !empty($images) ? $images[0] : 'path/to/default/image.jpg';
                        @endphp
                        <div class="destination-item style-two" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <img src="{{ asset('storage/' . $displayImage) }}" alt="{{ $package->destination_name }}">
                            </div>
                            <div class="contents">
                                <h6><a href="{{ route('destinationDetailpage', ['destination_slug' => $package->destination_slug]) }}">{{ $package->destination_name }}</a></h6>
                                {{-- <span class="tours">{{ $package->package_name }}</span> --}}
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No destinations available at the moment.</p>
                @endif
            </div>
            
            
        </div>
    </section> -->
    <!-- Destinations Area end -->


    <!-- Features Tours Area start -->
    <!-- <section class="features-tour-area bgc-black text-white pt-100 pb-50 rel z-1">
                <div class="container">
                    <div class="row justify-content-between align-items-center pb-25">
                        <div class="col-lg-6">
                            <div class="section-title counter-text-wrap mb-20" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h2>Discover Tours</h2>
                                <p>One site <span class="count-text plus bgc-primary" data-speed="3000" data-stop="34500">0</span> most popular experience</p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <ul class="destinations-nav style-two mb-20">
                                <li data-filter="*" class="active">Show All</li>
                                <li data-filter=".beach">Beach</li>
                                <li data-filter=".museum">Museum</li>
                                <li data-filter=".park">Park</li>
                                <li data-filter=".city">City</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row destinations-active justify-content-center">
                        <div class="col-xl-3 col-lg-4 col-md-6 item beach park">
                            <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <span class="badge">10% Off</span>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/tour1.jpg" alt="Tour">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali, Indonesia</span>
                                    <h6><a href="tour-details.php">Relinking Beach in Nusa panada island, Bali, Indonesia</a></h6>
                                </div>
                                <div class="destination-footer">
                                    <span class="price"><span>$58.00</span>/person</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <a href="tour-details.php" class="theme-btn style-three">
                                    <span data-hover="Explore">Explore</span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 item museum park city">
                            <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/tour2.jpg" alt="Tour">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> New Zealand</span>
                                    <h6><a href="tour-details.php">Relinking Beach in Nusa panada island, Bali, Indonesia</a></h6>
                                </div>
                                <div class="destination-footer">
                                    <span class="price"><span>$58.00</span>/person</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <a href="tour-details.php" class="theme-btn style-three">
                                    <span data-hover="Explore">Explore</span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 item beach city">
                            <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <span class="badge bgc-pink">Featured</span>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/tour3.jpg" alt="Tour">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali, Indonesia</span>
                                    <h6><a href="tour-details.php">Relinking Beach in Nusa panada island, Bali, Indonesia</a></h6>
                                </div>
                                <div class="destination-footer">
                                    <span class="price"><span>$58.00</span>/person</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <a href="tour-details.php" class="theme-btn style-three">
                                    <span data-hover="Explore">Explore</span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 item beach museum">
                            <div class="destination-item style-four no-border" data-aos="flip-left" data-aos-delay="150" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/tour4.jpg" alt="Tour">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                                    <h6><a href="tour-details.php">Relinking Beach in Nusa panada island, Bali, Indonesia</a></h6>
                                </div>
                                <div class="destination-footer">
                                    <span class="price"><span>$58.00</span>/person</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <a href="tour-details.php" class="theme-btn style-three">
                                    <span data-hover="Explore">Explore</span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
    <!-- Features Tours Area end -->


    <!-- Popular Activity Area start -->
    <!-- <section class="popular-activity pt-100 pb-70 rel z-1">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="section-title text-center counter-text-wrap mb-45" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h2>Explore Our Popular Activity</h2>
                                <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most popular experience</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity1.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">Mountain Trek</a></h5>
                                    <span class="time">258 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity2.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">Beach Snorkel</a></h5>
                                    <span class="time">320 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity3.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">Explore Ruins</a></h5>
                                    <span class="time">258 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity4.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">Road Trip</a></h5>
                                    <span class="time">258 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity5.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">City Cycling</a></h5>
                                    <span class="time">320 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity6.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">River Cruise</a></h5>
                                    <span class="time">258 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity7.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">Fishing</a></h5>
                                    <span class="time">258 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity8.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">Spa Treatment</a></h5>
                                    <span class="time">320 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="flip-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="activity-item">
                                <div class="image">
                                    <img src="assets/images/activities/activity9.png" alt="Activity">
                                </div>
                                <div class="content">
                                    <h5><a href="tour-details.php">Hiking Trekking</a></h5>
                                    <span class="time">258 tours</span>
                                </div>
                                <div class="right-btn">
                                    <a href="tour-details.php" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
    <!-- Popular Activity Area end -->


    <!-- CTA Area start -->
    <!-- <section class="cta-area rel z-1">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                            <div class="cta-item" style="background-image: url(assets/images/cta/cta1.jpg);">
                                <span class="category">Tent Camping</span>
                                <h2>Explore the world best tourism</h2>
                                <a href="tour-details.php" class="theme-btn style-two bgc-secondary">
                                    <span data-hover="Explore Tours">Explore Tours</span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                            <div class="cta-item" style="background-image: url(assets/images/cta/cta2.jpg);">
                                <span class="category">Sea Beach</span>
                                <h2>World largest Sea Beach in Thailand</h2>
                                <a href="tour-details.php" class="theme-btn style-two">
                                    <span data-hover="Explore Tours">Explore Tours</span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <div class="cta-item" style="background-image: url(assets/images/cta/cta3.jpg);">
                                <span class="category">Water Falls</span>
                                <h2>Largest Water falls Bali, Indonesia</h2>
                                <a href="tour-details.php" class="theme-btn style-two bgc-secondary">
                                    <span data-hover="Explore Tours">Explore Tours</span>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
    <!-- CTA Area end -->


    <!-- Hotel Area start -->
    <!-- <section class="hotel-area py-70 rel z-1">
                <div class="container">
                    <div class="row justify-content-between align-items-center pb-40">
                        <div class="col-lg-9">
                            <div class="section-title counter-text-wrap mb-15" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h2>Discover the World's Class Top Hotel</h2>
                                <p>One site <span class="count-text plus bgc-primary" data-speed="3000" data-stop="34500">0</span> most popular experience you’ll remember</p>
                            </div>
                        </div>
                        <div class="col-lg-3 text-xl-end">
                            <a href="tour-list.php" class="theme-btn style-two bgc-secondary mb-15">
                                <span data-hover="Explore More Hotel">Explore More Hotel</span>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-6 col-xl-8 col-lg-10">
                            <div class="destination-item style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/hotel5.jpg" alt="Hotel">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Ao Nang, Thailand</span>
                                    <h5><a href="tour-details.php">The brown bench near swimming pool Hotel</a></h5>
                                    <ul class="list-style-one">
                                        <li><i class="fal fa-bed-alt"></i> 2 Bed room</li>
                                        <li><i class="fal fa-hat-chef"></i> 1 kitchen</li>
                                        <li><i class="fal fa-bath"></i> 2 Wash room</li>
                                        <li><i class="fal fa-router"></i> Internet</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$85.00</span>/per night</span>
                                        <a href="tour-details.php" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-8 col-lg-10">
                            <div class="destination-item style-three bgc-lighter" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/hotel6.jpg" alt="Hotel">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Kigali, Rwanda</span>
                                    <h5><a href="tour-details.php">Green trees and body of water Marriott Hotel</a></h5>
                                    <ul class="list-style-one">
                                        <li><i class="fal fa-bed-alt"></i> 2 Bed room</li>
                                        <li><i class="fal fa-hat-chef"></i> 1 kitchen</li>
                                        <li><i class="fal fa-bath"></i> 2 Wash room</li>
                                        <li><i class="fal fa-router"></i> Internet</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$85.00</span>/per night</span>
                                        <a href="tour-details.php" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-8 col-lg-10">
                            <div class="destination-item style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/hotel7.jpg" alt="Hotel">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Ao Nang, Thailand</span>
                                    <h5><a href="tour-details.php">Painted house surround with trees Hotel</a></h5>
                                    <ul class="list-style-one">
                                        <li><i class="fal fa-bed-alt"></i> 2 Bed room</li>
                                        <li><i class="fal fa-hat-chef"></i> 1 kitchen</li>
                                        <li><i class="fal fa-bath"></i> 2 Wash room</li>
                                        <li><i class="fal fa-router"></i> Internet</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$85.00</span>/per night</span>
                                        <a href="tour-details.php" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-8 col-lg-10">
                            <div class="destination-item style-three bgc-lighter" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/hotel8.jpg" alt="Hotel">
                                </div>
                                <div class="content">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Ao Nang, Thailand</span>
                                    <h5><a href="tour-details.php">House pool Jungle Pool Indonesia Hotel</a></h5>
                                    <ul class="list-style-one">
                                        <li><i class="fal fa-bed-alt"></i> 2 Bed room</li>
                                        <li><i class="fal fa-hat-chef"></i> 1 kitchen</li>
                                        <li><i class="fal fa-bath"></i> 2 Wash room</li>
                                        <li><i class="fal fa-router"></i> Internet</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$85.00</span>/per night</span>
                                        <a href="tour-details.php" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
    <!-- Hotel Area end -->


    <!-- Newsletter Area start -->
    <!-- <section class="newsletter-three bgc-primary py-100 rel z-1" style="background-image: url(assets/images/newsletter/newsletter-bg-lines.png);">
                <div class="container container-1500">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right" data-aos-duration="1500" data-aos-offset="50">
                                <div class="section-title counter-text-wrap mb-45">
                                    <h2>Subscribe Our Newsletter to Get more offer & Tips</h2>
                                    <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most popular experience you’ll remember</p>
                                </div>
                                <form class="newsletter-form mb-15" action="#">
                                    <input id="news-email" type="email" placeholder="Email Address" required>
                                    <button type="submit" class="theme-btn bgc-secondary style-two">
                                        <span data-hover="Subscribe">Subscribe</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </form>
                                <p>No credit card requirement. No commitments</p>
                            </div>
                            <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                                <img src="assets/images/newsletter/newsletter-bg-image.png" alt="Newsletter">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="newsletter-image-part bgs-cover" style="background-image: url(assets/images/newsletter/newsletter-two-right.jpg);" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
                        </div>
                    </div>
                </div>
            </section> -->
    <!-- Newsletter Area end -->

    <style>
        .destination-active .destination-item.style-two .image img {
    border-radius: 50%;
    display: inline-block;
    width: 170px;
    height: 170px;
    object-fit: cover;
}
/* General fixed size for most images */
        .fixed-image-size img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
            margin-top: 10px;
        }

        /* Unique style for the second image */
        .unique-image-size img {
            width: 100%;
            margin-top: 10px;
            height: 610px;
            /* Taller height for the second image */
            /* object-fit: contain; Ensures the whole image is visible */
            border-radius: 10px;
            object-fit: cover;
            /* Different rounded corners */
            /* border: 2px solid #ccc; Optional: Add a border for distinction */
        }

        @media(max-width:992px) {
            .below-image {
                display: flex;
                justify-content: center !important;
                grid-gap: 10px;
                margin-top: -10px !important;
            }

            .fixed-image-size img {
                width: 100%;
                height: 300px;
                max-width: 552px !important;
                min-width: 376px !important;
                object-fit: cover;
                border-radius: 5px;
                margin-top: 10px;
            }
        }


        @media (max-width: 768px) {

            .below-image {
                display: block;
                justify-content: center !important;
                grid-gap: 10px;
                margin-top: -10px !important;
            }

            .fixed-image-size img {
                width: 100% !important;
                min-width: 100% !important;
                object-fit: cover;
            }

            .unique-image-size img {
                width: 100%;
                margin-top: 0px !important;
                height: 300px;
                /* Taller height for the second image */
                /* object-fit: contain; Ensures the whole image is visible */
                border-radius: 10px;
                object-fit: cover;
                /* Different rounded corners */
                /* border: 2px solid #ccc; Optional: Add a border for distinction */
            }
        }

    </style>
@endsection
