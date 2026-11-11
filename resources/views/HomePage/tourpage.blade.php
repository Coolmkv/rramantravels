@extends('layouts.webSite')

@section('title', 'Tour')
@section('content')



    <!-- Tour Grid Area start -->
    <style>
       
       
        /* Floating background elements */
        .bg-decoration {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            animation: float 6s ease-in-out infinite;
            pointer-events: none;
        }

        .bg-decoration:nth-child(1) {
            width: 200px;
            height: 200px;
            top: 10%;
            left: -5%;
            animation-delay: 0s;
        }

        .bg-decoration:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 60%;
            right: -3%;
            animation-delay: 2s;
        }

        .bg-decoration:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 30%;
            right: 15%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(5deg); }
            50% { transform: translateY(-10px) rotate(-5deg); }
            75% { transform: translateY(-30px) rotate(3deg); }
        }

        .section-header {
            text-align: center;
            position: relative;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            position: relative;
            animation: titleSlideIn 1s ease-out;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color:black;
            font-weight: 300;
            animation: subtitleSlideIn 1s ease-out 0.3s both;
        }

        @keyframes titleSlideIn {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes subtitleSlideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tours-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        .tour-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: cardSlideUp 0.8s ease-out;
            animation-fill-mode: both;
        }

        .tour-card:nth-child(1) { animation-delay: 0.2s; }
        .tour-card:nth-child(2) { animation-delay: 0.4s; }
        .tour-card:nth-child(3) { animation-delay: 0.6s; }

        @keyframes cardSlideUp {
            from { opacity: 0; transform: translateY(60px) scale(0.9); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .tour-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b35, #f7931e, #ffc107);
            transform: scaleX(0);
            transition: transform 0.5s ease;
        }

        .tour-card:hover {
            transform: translateY(-20px) scale(1.02);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.2);
        }

        .tour-card:hover::before {
            transform: scaleX(1);
        }

        .card-image {
            width: 100%;
            height: 280px;
            position: relative;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            filter: brightness(1) saturate(1.1);
        }

        .tour-card:hover .card-image img {
            transform: scale(1.1) rotate(2deg);
            filter: brightness(1.1) saturate(1.3);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .tour-card:hover .image-overlay {
            opacity: 1;
        }

        .featured-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
            animation: badgePulse 2s infinite;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .card-content {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            padding: 35px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .card-content::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            transform: scale(0);
            transition: transform 0.6s ease;
        }

        .tour-card:hover .card-content::before {
            transform: scale(1);
        }

        .location {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 1rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .location-icon {
            width: 18px;
            height: 18px;
            fill: currentColor;
            animation: iconBounce 2s ease-in-out infinite;
        }

        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .tour-title {
            font-size: 1.9rem;
            font-weight: 700;
            line-height: 1.3;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .duration {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            font-size: 1rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .clock-icon {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        .view-more-btn {
            background: white;
            color: #333;
            border: none;
            padding: 15px 35px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            display: flex;
            align-items: center;
            gap: 12px;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .view-more-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .view-more-btn:hover::before {
            left: 100%;
        }

        .view-more-btn:hover {
            background: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .arrow-icon {
            width: 18px;
            height: 18px;
            fill: currentColor;
            transition: transform 0.4s ease;
        }

        .view-more-btn:hover .arrow-icon {
            transform: translateX(8px);
        }

        .stats-overlay {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 10px 15px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.4s ease;
        }

        .tour-card:hover .stats-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .tours-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            
            .section-title {
                font-size: 2.8rem;
                margin-bottom: 15px;
            }
            
            .section-subtitle {
                font-size: 1.1rem;
            }
            
            .tours-grid {
                grid-template-columns: 1fr;
                gap: 25px;
                margin-top: 30px;
            }
            
            .card-content {
                padding: 30px 25px;
            }
            
            .tour-title {
                font-size: 1.6rem;
            }
            
            .view-more-btn {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }

        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }



         .section   {
            font-size: 3rem;
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

        .section ::after {
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
        .hovering:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>
<section class="pt-140 py-100">
            <div class="blog-banner"  style=" ">
    <img src="./assets/images/odisha.jpeg" style="max-height:200px;width:100%" alt=""> 
           </div> 
           <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* General Form Styles */
    .search-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        padding: 20px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        gap: 20px;
        flex-wrap: wrap;
        max-width: 1300px;
        margin: 0 auto;
        border-radius: 15px;
    }

    .form-heading {
        flex-basis: 100%;
        text-align: center;
        font-size: 1.3rem;
        font-weight: bold;
        color: black;
        margin-bottom: 10px;
    }

    /* Form Group with Icon Inside Box */
    .form-group {
        position: relative;
        flex: 1;
        min-width: 200px;
    margin-bottom:0px !important;
    }

    .form-group i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #888;
        font-size: 1rem;
        pointer-events: none;
        transition: 0.3s;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 12px 12px 45px; /* space for icon */
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        font-size: 1rem;
        font-weight: 500;
        background: #fafafa;
        transition: 0.3s;
    }

    /* Focus Effect */
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #43a047;
        background: #fff;
    }

    .form-group input:focus + i,
    .form-group textarea:focus + i {
        color: #43a047;
    }

    textarea {
        resize: none;
    }

    .search-btn {
        background: #F1C40F;
        color: black;
        border: none;
        border-radius: 30px;
        padding: 14px 30px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        white-space: nowrap;
        align-self: center;
    }

    .search-btn:hover {
        background: #43a047;
        color: #fff;
    }

    /* Medium Devices (Tablets: 768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .search-form {
            gap: 15px;
            padding: 15px;
        }

        .form-group {
            flex: 1 1 calc(50% - 7.5px);
        }

        .search-btn {
            flex-basis: 100%;
            margin-top: 10px;
        }
    }

    /* Small Devices (Mobile: <768px) */
    @media (max-width: 767px) {
        .search-form {
            flex-direction: column;
            gap: 12px;
            padding: 15px;
        }

        .form-group {
            flex: 1 1 100%;
        }

        .search-btn {
            width: 100%;
        }
    }
</style>

<section style="margin-bottom:50px;">
    <form id="aboutForm" class="search-form">
        @csrf
        <span class="form-heading">Discover Odisha: Where Culture Meets Adventure</span>

        <div class="form-group">
            <input type="text" name="name" placeholder="Your Name" required>
            <i class="fa fa-user"></i>
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" required>
            <i class="fa fa-envelope"></i>
        </div>

        <div class="form-group">
            <input type="tel" name="phone" placeholder="Your Phone" required>
            <i class="fa fa-phone"></i>
        </div>

        <div class="form-group">
            <textarea name="message" placeholder="Your Message" rows="1" cols="25" required></textarea>
            <i class="fa fa-comment"></i>
        </div>

        <button class="search-btn" type="submit">Submit</button>
    </form>
</section>
<script>
    document.getElementById('aboutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // prevent default form submit

        let form = e.target;
        let formData = new FormData(form);

        fetch("{{ route('query.submit') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Show toast message
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });

            // Reset form fields
            form.reset();
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        });
    });
    </script>
    
    <div class="bg-decoration"></div>
    <div class="bg-decoration"></div>
    <div class="bg-decoration"></div>
      

    <div class="container ">
       
       
        <div class="section-header">
            <h2 class="section">Popular Packages</h2>
            <p class="section-subtitle">Discover extraordinary destinations with our premium travel experiences</p>
        </div>
        
        <hr class="mb-50">
            <div class="row">
                @if (isset($packages) && count($packages) > 0)
                    @foreach ($packages as $item)
                        @php
                            // Ensure package_image is a valid JSON string before decoding
                            $images = is_string($item->package_image)
                                ? json_decode($item->package_image, true)
                                : $item->package_image;

                            // Check if images is a valid array and get the first image
                            $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                        @endphp
                        <div class="col-xl-4 col-md-6 hovering">
                            <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                                data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    @if ($displayImage)
                                        {{-- <figure class="images"> --}}
                                        <img src="{{ asset('storage/' . $displayImage) }}" alt="{{ $item->package_name }}"
                                            class="gallery-image">
                                        {{-- </figure> --}}
                                    @else
                                        {{-- <figure class="images"> --}}
                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image">
                                        {{-- </figure> --}}
                                    @endif

                                    <div class="ratting">{{ $item->package_type }}</div>
                                </div>
                                <div class="content">
                                    <div class="destination-header">
                                        <span class="location"><i class="fal fa-map-marker-alt"></i>
                                            {{ $item->package_country }}</span>
                                        {{-- <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div> --}}
                                    </div>
                                    <h5 class="card-heading" style="text-align:left">{!! $item->package_name !!}</h5>
                                    {{-- <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p> --}}
                                    <ul class="blog-meta">
                                        <li><i class="far fa-clock"></i> {!! $item->package_duration_days !!} Days /
                                            {!! $item->package_duration_nights !!} Nights</li>
                                        {{-- <li><i class="far fa-user"></i> 5-8 guest</li> --}}
                                    </ul>
                                    <div class="destination-footers">
                                        <!-- <span class="price"><span>$58.00</span>/person</span> -->
                                        <a href="{{ route('tourDetailpage', ['slug' => $item->slug]) }}" class="theme-btn style-two style-three">
                                            <span data-hover="Book Now text-center">View More</span>
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-xl-4 col-md-6">
                        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-delay="50" data-aos-offset="50">
                            <div class="image">
                                <span class="badge bgc">Featured</span>
                                <!-- <a href="#" class="heart"><i class="fas fa-heart"></i></a> -->
                                <img src="./assets/images/gallery2.jpg" alt="Tour List">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                                    {{-- <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div> --}}
                                </div>
                                <h5><a href="{{ route('tourpage') }}">Buenos Aires, Calafate & Ushuaia, Rome,
                                        Italy</a></h5>
                                {{-- <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p> --}}
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                    {{-- <li><i class="far fa-user"></i> 5-8 guest</li> --}}
                                </ul>
                                <div class="destination-footers">
                                    <!-- <span class="price"><span>$58.00</span>/person</span> -->
                                    <a href="{{ route('tourpage') }}" class="theme-btn style-two style-three">
                                        <span data-hover="Book Now">View More</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-delay="100" data-aos-offset="50">
                            <div class="image">
                                <span class="badge bgc">Featured</span>
                                <!-- <a href="#" class="heart"><i class="fas fa-heart"></i></a> -->
                                <img src="./assets/images/gallery3.jpg" alt="Tour List">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali, Indonesia</span>
                                    {{-- <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div> --}}
                                </div>
                                <h5><a href="{{ route('tourpage') }}">Bay Cruise lake trip by Boat in Bali,
                                        Indonesia</a></h5>
                                {{-- <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p> --}}
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                    {{-- <li><i class="far fa-user"></i> 5-8 guest</li> --}}
                                </ul>
                                <div class="destination-footers">
                                    <!-- <span class="price"><span>$58.00</span>/person</span> -->
                                    <a href="{{ route('tourpage') }}" class="theme-btn style-two style-three">
                                        <span data-hover="Book Now">View More</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <span class="badge bgc">Featured</span>
                                <!-- <a href="#" class="heart"><i class="fas fa-heart"></i></a> -->
                                <img src="./assets/images/gallery4.jpg" alt="Tour List">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                                    {{-- <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div> --}}
                                </div>
                                <h5><a href="{{ route('tourpage') }}">Buenos Aires, Calafate & Ushuaia, Rome,
                                        Italy</a></h5>
                                {{-- <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p> --}}
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                    {{-- <li><i class="far fa-user"></i> 5-8 guest</li> --}}
                                </ul>
                                <div class="destination-footers">
                                    <!-- <span class="price"><span>$58.00</span>/person</span> -->
                                    <a href="{{ route('tourpage') }}" class="theme-btn style-two style-three">
                                        <span data-hover="Book Now">View More</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-delay="50" data-aos-offset="50">
                            <div class="image">
                                <span class="badge bgc-pink">Featured</span>
                                <!-- <a href="#" class="heart"><i class="fas fa-heart"></i></a> -->
                                <img src="./assets/images/gallery5.jpg" alt="Tour List">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                                    {{-- <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div> --}}
                                </div>
                                <h5><a href="{{ route('tourpage') }}">Buenos Aires, Calafate & Ushuaia, Rome,
                                        Italy</a></h5>
                                {{-- <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p> --}}
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                    {{-- <li><i class="far fa-user"></i> 5-8 guest</li> --}}
                                </ul>
                                <div class="destination-footers">
                                    <!-- <span class="price"><span>$58.00</span>/person</span> -->
                                    <a href="{{ route('tourpage') }}" class="theme-btn style-two style-three">
                                        <span data-hover="Book Now">View More</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-delay="100" data-aos-offset="50">
                            <div class="image">
                                <span class="badge bgc">Featured</span>
                                <!-- <a href="#" class="heart"><i class="fas fa-heart"></i></a> -->
                                <img src="./assets/images/gallery6.jpg" alt="Tour List">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali, Indonesia</span>
                                    {{-- <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div> --}}
                                </div>
                                <h5><a href="{{ route('tourpage') }}">Bay Cruise lake trip by Boat in Bali,
                                        Indonesia</a></h5>
                                {{-- <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p> --}}
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                    {{-- <li><i class="far fa-user"></i> 5-8 guest</li> --}}
                                </ul>
                                <div class="destination-footers">
                                    <!-- <span class="price"><span>$58.00</span>/person</span> -->
                                    <a href="{{ route('tourpage') }}" class="theme-btn style-two style-three">
                                        <span data-hover="Book Now">View More</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- <div class="col-xl-4 col-md-6">
                            <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <span class="badge">10% Off</span>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/tour-list7.jpg" alt="Tour List">
                                </div>
                                <div class="content">
                                    <div class="destination-header">
                                        <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                                        <div class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="tour-details.php">Buenos Aires, Calafate & Ushuaia, Rome, Italy</a></h5>
                                    <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p>
                                    <ul class="blog-meta">
                                        <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                        <li><i class="far fa-user"></i> 5-8 guest</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$58.00</span>/person</span>
                                        <a href="tour-details.php" class="theme-btn style-two style-three">
                                            <span data-hover="Book Now">Book Now</span>
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="50" data-aos-offset="50">
                                <div class="image">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/tour-list8.jpg" alt="Tour List">
                                </div>
                                <div class="content">
                                    <div class="destination-header">
                                        <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                                        <div class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="tour-details.php">Buenos Aires, Calafate & Ushuaia, Rome, Italy</a></h5>
                                    <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p>
                                    <ul class="blog-meta">
                                        <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                        <li><i class="far fa-user"></i> 5-8 guest</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$58.00</span>/person</span>
                                        <a href="tour-details.php" class="theme-btn style-two style-three">
                                            <span data-hover="Book Now">Book Now</span>
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100" data-aos-offset="50">
                                <div class="image">
                                    <span class="badge bgc-primary">Popular</span>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="assets/images/destinations/tour-list9.jpg" alt="Tour List">
                                </div>
                                <div class="content">
                                    <div class="destination-header">
                                        <span class="location"><i class="fal fa-map-marker-alt"></i> Bali, Indonesia</span>
                                        <div class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h5><a href="tour-details.php">Bay Cruise lake trip by Boat in Bali, Indonesia</a></h5>
                                    <p>Bali, Indonesia, is tropical paradise renowned breathtaking beaches and landscapes</p>
                                    <ul class="blog-meta">
                                        <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                        <li><i class="far fa-user"></i> 5-8 guest</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$58.00</span>/person</span>
                                        <a href="tour-details.php" class="theme-btn style-two style-three">
                                            <span data-hover="Book Now">Book Now</span>
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <ul class="pagination justify-content-center pt-15 flex-wrap" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="far fa-chevron-left"></i></span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">
                                        1
                                        <span class="sr-only">(current)</span>
                                    </span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="far fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </div> -->
            </div>
    </div>
    </section>
    <script>
        // Add interactive functionality
        function handleBooking(tourId) {
            const btn = event.target.closest('.view-more-btn');
            const originalText = btn.innerHTML;
            
            // Show loading state
            btn.innerHTML = `
                <div class="loading-spinner"></div>
                Processing...
            `;
            btn.style.pointerEvents = 'none';
            
            // Simulate booking process
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.pointerEvents = 'auto';
                
                // Show success message (in a real app, this would navigate to booking page)
                showNotification(`Tour ${tourId} details loading...`);
            }, 2000);
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 15px 25px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                z-index: 1000;
                font-weight: 600;
                animation: slideInRight 0.5s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.5s ease';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }

        // Add scroll animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        });

        document.querySelectorAll('.tour-card').forEach(card => {
            observer.observe(card);
        });

        // Add dynamic styles for animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>


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
        h5.card-heading {
    color: #fff;
}
    </style>
@endsection
