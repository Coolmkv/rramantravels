@extends('layouts.webSite')
@section('content')
    <!-- about-section -->
    <!-- Hero Area Start -->
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Hero Section with Overlay Form -->
    <section class="hero-section">
        @if($sliders->isNotEmpty())
            <div class="home-slides" aria-label="Featured travel slides">
                @foreach($sliders as $index => $slide)
                    <div class="home-slide {{ $index === 0 ? 'active' : '' }}"
                        style="background-image: url('{{ asset(ltrim($slide->image, '/')) }}')"
                        aria-hidden="{{ $index === 0 ? 'false' : 'true' }}">
                        @if($slide->heading_top || $slide->heading_middle || $slide->heading_bottom)
                            <div class="home-slide-copy">
                                @if($slide->heading_top)
                                    <p>{{ $slide->heading_top }}</p>
                                @endif
                                @if($slide->heading_middle)
                                    <h1>{{ $slide->heading_middle }}</h1>
                                @endif
                                @if($slide->heading_bottom)
                                    <p>{{ $slide->heading_bottom }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="video-background">
                <iframe
                    src="https://www.youtube.com/embed/_gu9BwQ1Ags?autoplay=1&mute=1&loop=1&playlist=_gu9BwQ1Ags&controls=0&modestbranding=1&fs=0&rel=0"
                    title="Background Video" allow="autoplay; encrypted-media" allowfullscreen style="pointer-events: none;">
                </iframe>
            </div>
        @endif

        <div class="hero-content">
            <form class="search-form" action="{{ route('query.submit') }}" method="POST" style="padding-bottom:30px;">
                @csrf
                <span class="form-heading">Discover Odisha: Where Culture Meets Adventure</span>

                <div class="form-group">
                    <i class="fa fa-user"></i>
                    <input type="text" name="name" placeholder="Your Name" required>
                </div>

                <div class="form-group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="Your Email" required>
                </div>

                <div class="form-group">
                    <i class="fa fa-phone"></i>
                    <input type="tel" name="phone" placeholder="Your Phone" required>
                </div>

                <div class="form-group">
                    <i class="fa fa-comment"></i>
                    <textarea name="message" placeholder="Your Message" rows="1" cols="25" required></textarea>
                </div>

                <button class="search-btn" type="submit">Submit</button>
            </form>
        </div>
    </section>

    @if($sliders->count() > 1)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const slides = document.querySelectorAll('.home-slide');
                let activeIndex = 0;

                window.setInterval(function () {
                    slides[activeIndex].classList.remove('active');
                    slides[activeIndex].setAttribute('aria-hidden', 'true');
                    activeIndex = (activeIndex + 1) % slides.length;
                    slides[activeIndex].classList.add('active');
                    slides[activeIndex].setAttribute('aria-hidden', 'false');
                }, 5000);
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.search-form');

            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Stop the default form submission

                const formData = new FormData(form);
                const submitBtn = form.querySelector('.search-btn');

                // Disable button
                submitBtn.disabled = true;
                submitBtn.textContent = 'Submitting...';

                // Send AJAX request
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Success!
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end',
                            timerProgressBar: true
                        });

                        // Reset the form
                        form.reset();
                    })
                    .catch(error => {
                        // Error
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong. Please try again.',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end',
                            timerProgressBar: true
                        });
                    })
                    .finally(() => {
                        // Re-enable button
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Submit';
                    });
            });
        });
    </script>
    <!-- Below-Video Form for Tablets & Mobile -->
    <section class="form-below-video">
        <form class="search-form" action="{{ route('query.submit') }}" method="POST">
            @csrf
            <span class="form-heading" style="color:black">Send Us Your Query</span>
            <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" placeholder="Your Phone" required>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Your Message" rows="1" cols="25" required></textarea>
            </div>
            <button class="search-btn" type="submit">Submit</button>
        </form>
    </section>
    </body>

    </html>

    <!-- Demo content below hero -->


    <!-- About Us Area start -->

    <section class="about-us-area py-100 rpb-90 rel z-1">
        <!-- Floating Travel Icons Background -->
        <div class="floating-icons">
            <i class="fas fa-plane floating-icon"></i>
            <i class="fas fa-map-marker-alt floating-icon"></i>
            <i class="fas fa-compass floating-icon"></i>
            <i class="fas fa-camera floating-icon"></i>
            <i class="fas fa-suitcase floating-icon"></i>
            <i class="fas fa-globe-asia floating-icon"></i>
        </div>

        <!-- Pulsing decorative dots -->
        <div class="pulse-dot pulse-dot-1"></div>
        <div class="pulse-dot pulse-dot-2"></div>
        <div class="pulse-dot pulse-dot-3"></div>

        <div class="container">
            <div class="row align-items-center">
                <h2 class="text-center mb-4 popular-destination" data-aos="fade-up">About Us</h2>

                <!-- Text Content -->
                <div class="col-xl-6 col-lg-6">
                    <div class="about-us-content rmb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">

                        <!-- Dynamic OR Static Content -->
                        <p style="color: black !important;">
                            {!! $home_aboutus_content ??
        'Odisha, often called the "Soul of India," is a land of rich history, vibrant culture, and breathtaking natural beauty. From ancient temples to pristine beaches and lush national parks, this eastern state offers a unique and unforgettable travel experience.' 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                !!}
                        </p>

                        <div class="menu-btns py-10">
                            <a href="#" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Book Now">Read More</span>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Image with 2D & 3D Animations -->
                <div class="col-xl-6 col-lg-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                    <div class="animated-image relative w-full h-0 pb-[66.66%]">

                        <!-- Dynamic OR Static Image -->
                        <img src="{{ 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        isset($home_aboutus_content_image) && !empty($home_aboutus_content_image)
        ? url($home_aboutus_content_image)
        : 'https://odishavoyages.com/wp-content/uploads/2021/10/jagannath-temple-pti-1616946876.jpg' 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }}"
                            alt=" About Us Image"
                            class="absolute top-0 left-0 w-full h-full object-cover rounded-lg shadow-lg">


                        <!-- Floating mini travel icon -->
                        <div
                            style="position: absolute; top: 10%; right: 10%; width: 40px; height: 40px; background: rgba(255, 107, 107, 0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; animation: iconFloat 3s ease-in-out infinite;">
                            <i class="fas fa-om"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 1000,
            offset: 100,
            once: true
        });

        // Add floating animation for image overlay icons
        const style = document.createElement('style');
        style.textContent = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @keyframes iconFloat {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    0%, 100% { transform: translateY(0px) scale(1); }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    50% { transform: translateY(-15px) scale(1.1); }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            `;
        document.head.appendChild(style);

        // Add intersection observer for enhanced animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        // Observe elements
        document.querySelectorAll('.about-us-content, .animated-image').forEach(el => {
            observer.observe(el);
        });

        // Add hover effect to travel icons
        document.querySelectorAll('.travel-icons').forEach(icon => {
            icon.addEventListener('mouseenter', function () {
                this.style.transform = 'scale(1.2) rotate(15deg)';
                this.style.boxShadow = '0 8px 30px rgba(255, 107, 107, 0.6)';
            });

            icon.addEventListener('mouseleave', function () {
                this.style.transform = 'scale(1) rotate(0deg)';
                this.style.boxShadow = '0 5px 20px rgba(255, 107, 107, 0.4)';
            });
        });

        // Parallax effect for floating icons
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.5;

            document.querySelectorAll('.floating-icon').forEach((icon, index) => {
                const speed = (index + 1) * 0.1;
                icon.style.transform = `translateY(${rate * speed}px) rotate(${rate * 0.05}deg)`;
            });
        });

        // Add click animation to button
        document.querySelector('.theme-btn').addEventListener('click', function (e) {
            e.preventDefault();

            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.cssText = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    position: absolute;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    width: ${size}px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    height: ${size}px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    left: ${x}px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    top: ${y}px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    background: rgba(255, 255, 255, 0.5);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    border-radius: 50%;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    transform: scale(0);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    animation: ripple 0.6s ease-out;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    pointer-events: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `;

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Add ripple animation
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @keyframes ripple {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    to {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        transform: scale(2);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        opacity: 0;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            `;
        document.head.appendChild(rippleStyle);
    </script>

    @if(!empty($getPackages))
        <section id="travel-gallery">
            <!-- Floating Emoji Background -->
            <div class="bg-emoji-wrapper">
                <div class="animated-emoji">✈️</div>
                <div class="animated-emoji">🌍</div>
                <div class="animated-emoji">🏔️</div>
                <div class="animated-emoji">🏖️</div>
                <div class="animated-emoji">🗾</div>
                <div class="animated-emoji">🕌</div>
                <div class="animated-emoji">🏛️</div>
                <div class="animated-emoji">🎌</div>
                <div class="animated-emoji">⛩️</div>
            </div>

            <div class="destination-showcase">
                <div class="main-wrapper">
                    <!-- Section Title -->
                    <div class="hero-heading">
                        <h2 class="text-center">✨ Explore Popular Packages ✨</h2>
                        <p style="text-align:center">🌟 Discover incredible journeys and unforgettable experiences 🌟</p>
                    </div>

                    <!-- Swiper -->
                    <div class="swiper destination-slider">
                        <div class="swiper-wrapper">
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
                                    <div class="col-xxl-3 col-xl-4 col-md-6 swiper-slide">
                                        <a href="{{ route('tourDetailpage', ['slug' => $item->slug]) }}">
                                            <div class="destination-item" data-aos="fade-up" data-aos-duration="1500"
                                                data-aos-offset="50">
                                                <div class="image">
                                                    @if ($displayImage)
                                                        {{-- <figure class="images"> --}}
                                                            <img src="{{ asset('storage/' . $displayImage) }}"
                                                                alt="{{ $item->package_name }}" class="gallery-image">
                                                            {{--
                                                        </figure> --}}
                                                    @else
                                                        {{-- <figure class="images"> --}}
                                                            <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image">
                                                            {{--
                                                        </figure> --}}
                                                    @endif

                                                    <div class="ratting">{{ $item->package_type }}</div>
                                                </div>
                                                <div class="content tourpackage">
                                                    <span class="location">
                                                        <i class="fal fa-map-marker-alt"></i> {{ $item->package_country }}
                                                    </span>
                                                    <h5 class="card-heading">
                                                        {{ Str::limit($item->package_name, 15) }}
                                                    </h5>
                                                    <span class="time">
                                                        {!! $item->package_duration_days !!} Days /
                                                        {!! $item->package_duration_nights !!} Nights
                                                    </span>
                                                </div>
                                                <div class="destination-footer price">
                                                    <span class="offer-price" style="font-size:1.2rem">
                                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {!! IND_money_format($item->package_offer_price) !!}
                                                    </span>
                                                    <span class="sale-price">
                                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {!! IND_money_format($item->package_price) !!}
                                                    </span>
                                                    <span class="offer-amount" style="font-size:1rem">
                                                        Save <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ IND_money_format($item->package_price - $item->package_offer_price) }}
                                                    </span>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <p>NO Data Available</p>
                            @endif
                        </div>

                        <!-- Navigation -->
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="view-more-buttons">
                    <a class="service-view-buttons" href="{{ url('/tours') }}" style="text-decoration: none;">
                        <button type="button" class="theme-btn">
                            <span data-hover="Explore More">
                                Explore More
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>
    <script>
        const packageCount = {{ count($packages) }};

        const travelSwiper = new Swiper('#travel-gallery .destination-slider', {
            slidesPerView: 1,  // Start with 1 for mobile
            spaceBetween: 20,
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: {
                el: '#travel-gallery .swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '#travel-gallery .swiper-button-next',
                prevEl: '#travel-gallery .swiper-button-prev',
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 15 },  // Mobile
                576: { slidesPerView: 1, spaceBetween: 20 },  // Small mobile
                768: { slidesPerView: 2, spaceBetween: 20 },  // Tablet
                992: { slidesPerView: 3, spaceBetween: 25 },  // Desktop
                1200: { slidesPerView: 4, spaceBetween: 30 }, // Large desktop
            },
            speed: 800,
        });
    </script>





    <section class="destinations-area">
        <!-- Floating background elements -->
        <div class="floating-elements">
            <i class="fas fa-plane floating-element" style="font-size: 2rem;"></i>
            <i class="fas fa-map-marker-alt floating-element" style="font-size: 1.5rem;"></i>
            <i class="fas fa-compass floating-element" style="font-size: 1.8rem;"></i>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-white text-center counter-text-wrap mb-40">
                        <h2 class="popular-destination">Popular Attractions</h2>
                        <p style="color:black;">One site many popular experience you'll remember</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="swiper packages mt-4 ">
                    <div class="swiper-wrapper ">

                        {{-- ✅ If Dynamic Data Available --}}
                        @if($homedestinations->count() > 0)

                            @foreach($homedestinations as $destination)

                                <div class="swiper-slide">
                                    <a href="{{ url('destination/' . $destination->destination_slug) }}" class="destination-link">
                                        <div class="destination-item">
                                            <div class="image">
                                                @php
                                                    // Ensure package_image is a valid JSON string before decoding
                                                    $images = is_string($destination->destination_image)
                                                        ? json_decode($destination->destination_image, true)
                                                        : $destination->destination_image;

                                                    // Check if images is a valid array and get the first image
                                                    $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                                                @endphp

                                                @if ($displayImage)
                                                    <img src="{{ asset('storage/' . $displayImage) }}"
                                                        alt="{{ $destination->destination_name }}" class="hotel-image"
                                                        style="margin-right: 10px;">
                                                @else
                                                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image"
                                                        class="hotel-image">
                                                @endif

                                            </div>
                                            <div class="content">
                                                <span class="location">
                                                    <i class="fas fa-map-marker-alt"></i> {{ $destination->destination_name }}
                                                </span>
                                                <h5 class="card-heading">
                                                    {{ Str::limit(strip_tags($destination->destination_details), 50) }}
                                                </h5>
                                                <span class="time"
                                                    style="padding:10px;background:maroon;border-radius:20px;color:white;font-size:15px">
                                                    Explore Now
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach


                            {{-- ❌ If No Dynamic Data → Show Static Fallback --}}
                        @else
                            <div class="swiper-slide">
                                <a href="#" class="destination-link">
                                    <div class="destination-item">
                                        <div class="image">
                                            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=800&q=80"
                                                alt="Paris" class="hotel-image">
                                        </div>
                                        <div class="content">
                                            <span class="location"><i class="fas fa-map-marker-alt"></i> Paris, France</span>
                                            <h5 class="card-heading">Eiffel Tower & City of Lights</h5>
                                            <span class="time">5 days 4 nights</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="#" class="destination-link">
                                    <div class="destination-item">
                                        <div class="image">
                                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=800&q=80"
                                                alt="Santorini" class="hotel-image">
                                        </div>
                                        <div class="content">
                                            <span class="location"><i class="fas fa-map-marker-alt"></i> Santorini,
                                                Greece</span>
                                            <h5 class="card-heading">Blue Domes & Sunset Views</h5>
                                            <span class="time">4 days 3 nights</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="#" class="destination-link">
                                    <div class="destination-item">
                                        <div class="image">
                                            <img src="https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=800&q=80"
                                                alt="Dubai" class="hotel-image">
                                        </div>
                                        <div class="content">
                                            <span class="location"><i class="fas fa-map-marker-alt"></i> Dubai, UAE</span>
                                            <h5 class="card-heading">Modern Marvels & Desert Adventures</h5>
                                            <span class="time">6 days 5 nights</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="view-more-buttons">
                <a class="service-view-buttons" href="{{ url('/destinations') }}" style="text-decoration: none;">
                    <button type="button" class="theme-btn">
                        <span data-hover="Explore More">
                            Explore More
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </section>




    <!-- Destinations Area end -->

    <!-- Popular Destinations Area start -->




    <!-- Popular Destinations Area end -->
    <section class="destinations-area">
        <!-- Floating background elements -->
        <div class="floating-elements">
            <i class="fas fa-plane floating-element" style="font-size: 2rem;"></i>
            <i class="fas fa-map-marker-alt floating-element" style="font-size: 1.5rem;"></i>
            <i class="fas fa-compass floating-element" style="font-size: 1.8rem;"></i>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-white text-center counter-text-wrap mb-40">
                        <h2 class="popular-destination">Our Popular Activities</h2>
                        <p style="color:black;">One site many popular experience you'll remember</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="swiper packages mt-4 ">
                    <div class="swiper-wrapper ">

                        @if($activities->count() > 0)

                            @foreach($activities as $activitie)

                                <div class="swiper-slide">
                                    <a href="{{ url('activitiespage/' . $activitie->slug) }}" class="destination-link">
                                        <div class="destination-item">
                                            <div class="image">
                                                @php
                                                    $images = is_string($activitie->activity_image)
                                                        ? json_decode($activitie->activity_image, true)
                                                        : $activitie->activity_image;

                                                    // Check if images is a valid array and get the first image
                                                    $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                                                @endphp

                                                @if ($displayImage)
                                                    <img src="{{ asset('storage/' . $displayImage) }}"
                                                        alt="{{ $activitie->activity_name }}" class="hotel-image"
                                                        style="margin-right: 10px;">
                                                @else
                                                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image"
                                                        class="hotel-image">
                                                @endif

                                            </div>
                                            <div class="content">
                                                <span class="location" style="margin-bottom:40px;">
                                                    {{ $activitie->activity_name }}
                                                </span>
                                                <a href="{{ url('activities/' . $activitie->slug) }}"
                                                    style="padding:10px;background :maroon;border-radius:20px;color:white;font-size:15px">Explore
                                                    Now</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach


                            {{-- ❌ If No Dynamic Data → Show Static Fallback --}}
                        @else
                            <div class="swiper-slide">
                                <a href="#" class="destination-link">
                                    <div class="destination-item">
                                        <div class="image">
                                            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=800&q=80"
                                                alt="Paris" class="hotel-image">
                                        </div>
                                        <div class="content">
                                            <span class="location">Paris, France</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="#" class="destination-link">
                                    <div class="destination-item">
                                        <div class="image">
                                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=800&q=80"
                                                alt="Santorini" class="hotel-image">
                                        </div>
                                        <div class="content">
                                            <span class="location" style="margin-bottom:40px;"> Santorini, Greece</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="#" class="destination-link">
                                    <div class="destination-item">
                                        <div class="image">
                                            <img src="https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=800&q=80"
                                                alt="Dubai" class="hotel-image">
                                        </div>
                                        <div class="content">
                                            <span class="location" style="margin-bottom:40px;">Dubai, UAE</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="view-more-buttons" style="margin-bottom: 80px">
                <a class="service-view-buttons" href="{{ url('/activitiespage') }}" style="text-decoration: none;">
                    <button type="button" class="theme-btn">
                        <span data-hover="Explore More">
                            Explore More
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </section>


    {{-- <section class="destinations-area">
        <!-- Floating background elements -->
        <div class="floating-elements">
            <i class="fas fa-plane floating-element" style="font-size: 2rem;"></i>
            <i class="fas fa-map-marker-alt floating-element" style="font-size: 1.5rem;"></i>
            <i class="fas fa-compass floating-element" style="font-size: 1.8rem;"></i>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-white text-center counter-text-wrap mb-40">
                        <h2 class="popular-destination">Our Services</h2>
                        <p style="color:black;">✨ Quality services designed ✨</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Unique Swiper class -->
                <div class="swiper services-swiper mt-4">
                    <div class="swiper-wrapper">

                        @forelse($services as $service)
                        <div class="swiper-slide">
                            <a href="{{ route('servicePages', $service->id) }}" class="destination-link">
                                <div class="destination-item">
                                    <div class="image">
                                        <img src="{{ asset($service->service_image ?: 'path/to/default/image.jpg') }}"
                                            alt="{{ $service->service_name }}" class="hotel-image"
                                            style="margin-right: 10px;">
                                    </div>
                                    <div class="content">
                                        <span class="location" style="font-size:25px;font-weight:bold">
                                            {{ $service->service_name }}
                                        </span>
                                        <p class="text-white">{!! Str::limit($service->service_details, 80) !!}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @empty
                        <p>No Services Available</p>
                        @endforelse

                    </div>

                    <!-- Pagination -->

                </div>
            </div>
        </div>
    </section> --}}

    <!-- Swiper CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> -->

    <!-- Swiper JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->

    {{--
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var swiperservices = new Swiper(".services-swiper", {
                slidesPerView: 1,       // default
                spaceBetween: 15,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },

                breakpoints: {
                    320: { slidesPerView: 1, spaceBetween: 10 },  // small mobile
                    576: { slidesPerView: 1, spaceBetween: 15 },  // mobile
                    768: { slidesPerView: 2, spaceBetween: 15 },  // tablets
                    992: { slidesPerView: 3, spaceBetween: 20 },  // small desktops
                    1200: { slidesPerView: 3, spaceBetween: 25 },  // large desktops
                },
            });
        });
    </script>
    --}}



    <!-- Bootstrap CSS -->

    <section class="why-choose-section">
        <!-- Floating particles -->
        <div class="floating-particle particle-1"></div>
        <div class="floating-particle particle-2"></div>
        <div class="floating-particle particle-3"></div>
        <div class="floating-particle particle-4"></div>

        <div class="container">
            <div class="text-center mb-5">
                <h2>Why Choose Us?</h2>
                <p class="section-subtitle">Discover what makes us the preferred choice for thousands of travelers</p>
            </div>

            <div class="row g-4 stats-container">
                <!-- Card 1 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div class="feature-number">5+</div>
                        <p class="card-text">Years of Travel Experience</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="feature-number">1000+</div>
                        <p class="card-text">Satisfied Happy Customers</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="feature-number">35+</div>
                        <p class="card-text">Expert Team Members</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <div class="feature-number">24/7</div>
                        <p class="card-text">Online Support Available</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-patch-check"></i>
                        </div>
                        <div class="feature-number">100%</div>
                        <p class="card-text">Authorized Odisha Tourism</p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-gift"></i>
                        </div>
                        <div class="feature-number">Special</div>
                        <p class="card-text">Group Discount Offers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    {{--
    <script>
        // Add intersection observer for animation triggers
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe all feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });

        // Add counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.feature-number');

            counters.forEach(counter => {
                const target = counter.textContent;
                if (target.includes('+')) {
                    const num = parseInt(target.replace('+', ''));
                    let current = 0;
                    const increment = num / 50;

                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= num) {
                            counter.textContent = num + '+';
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(current) + '+';
                        }
                    }, 30);
                }
            });
        }

        // Trigger counter animation when section is visible
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    sectionObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        sectionObserver.observe(document.querySelector('.why-choose-section'));
    </script> --}}

    <script>
        // Use an IIFE to wrap the entire script. This creates a private scope,
        // ensuring that 'observerOptions' and other variables do not conflict 
        // with variables in the global scope or other scripts.
        (function () {
            // Add intersection observer for animation triggers
            const observerOptions = {
                threshold: 0.1,
                // A negative bottom margin (-100px) means the element must enter 
                // 100px deeper into the viewport before intersecting.
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Set the CSS animation to run when visible
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            // Observe all feature cards
            document.querySelectorAll('.feature-card').forEach(card => {
                observer.observe(card);
            });

            // Add counter animation function
            function animateCounters() {
                const counters = document.querySelectorAll('.feature-number');

                counters.forEach(counter => {
                    const targetText = counter.textContent;

                    // Only animate counters that contain a '+'
                    if (targetText.includes('+')) {
                        // Get the target number
                        const num = parseInt(targetText.replace('+', ''));
                        let current = 0;
                        // Calculate a smaller increment for a smooth 1.5-second animation (approx 50 steps * 30ms)
                        const increment = num / 50;

                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= num) {
                                // Ensure the final, exact target number is displayed
                                counter.textContent = num + '+';
                                clearInterval(timer);
                            } else {
                                // Display the floor of the current count
                                counter.textContent = Math.floor(current) + '+';
                            }
                        }, 30); // Run every 30 milliseconds
                    }
                });
            }

            // Trigger counter animation when section is visible
            const sectionObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        // Stop observing after the animation has been triggered once
                        sectionObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 }); // Trigger when 30% of the section is visible

            // Start observing the target section
            const whyChooseSection = document.querySelector('.why-choose-section');
            if (whyChooseSection) {
                sectionObserver.observe(whyChooseSection);
            }
        })(); // End of the IIFE
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <!-- Horizontal Scroll Section -->

    <!-- Features Area start -->

    <!-- Blog Area start -->
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}">

    <!-- Testimonial Slider Section -->
    <div id="testimonialSlider" class="swiper"
        style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(''); background-size: cover; background-position: center; margin-bottom: 50px; margin-top: 60px; transition: background-image 0.5s ease-in-out;">
        <h1 class="text-center text-light" style="font-size:45px;margin:40px;">What Our Clients Say</h1>
        <div id="testimonialWrapper" class="swiper-wrapper">

            @php
                // 1. Filter the testimonials to include only those with an image and NO video link
                $imageOnlyTestimonials = $testimonials->filter(function ($testimonial) {
                    // Assuming 'image' is the column for the image path
                    $hasImage = !empty($testimonial->image);
                    // Assuming 'youtube_link' is the column for the video link
                    $hasVideo = !empty($testimonial->youtube_link);

                    return $hasImage && !$hasVideo;
                });
            @endphp

            {{-- 2. Loop through the filtered collection --}}
            @foreach($imageOnlyTestimonials as $testimonial)
                <div class="swiper-slide" data-bg-image="{{ asset('storage/' . $testimonial->image) }}">
                    <div class="testimonialCard">
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Client" class="testimonialImg">
                        <p>"{{ $testimonial->heading_middle }}"</p>
                        <div class="testimonial-author">
                            <h4>{{ $testimonial->heading_bottom }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- 3. Optional: Add a check to prevent the slider from initializing if empty --}}
            @if($imageOnlyTestimonials->isEmpty())
                <div style="display: none;">No image-only testimonials found.</div>
            @endif

        </div>

        <div id="testimonialPagination" class="swiper-pagination"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const testimonialSlider = document.getElementById('testimonialSlider');

            const testimonialSwiper = new Swiper("#testimonialSlider", {
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: "#testimonialPagination",
                    clickable: true
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 1,
                        spaceBetween: 30
                    },
                },
                on: {
                    init: function () {
                        // Set initial background image when the slider is initialized
                        const activeSlide = this.slides[this.activeIndex];
                        const bgImage = activeSlide.getAttribute('data-bg-image');
                        if (bgImage) {
                            testimonialSlider.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('${bgImage}')`;
                        }
                    },
                    slideChange: function () {
                        // Change background image on slide change
                        const activeSlide = this.slides[this.activeIndex];
                        const bgImage = activeSlide.getAttribute('data-bg-image');
                        if (bgImage) {
                            testimonialSlider.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('${bgImage}')`;
                        }
                    }
                }
            });
        });
    </script>

    <!-- Blog Area end -->


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarTrigger = document.getElementById('calendarTrigger');
            const departureDateInput = document.getElementById('departure_date');
            const selectedDateText = document.getElementById('selectedDate');

            // Set the min attribute of the date input to today's date
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0]; // Format as YYYY-MM-DD
            departureDateInput.setAttribute('min', formattedDate);

            // Toggle visibility of the date input on clicking the calendar trigger
            calendarTrigger.addEventListener('click', function () {
                if (departureDateInput.style.display === 'none') {
                    departureDateInput.style.display = 'block';
                } else {
                    departureDateInput.style.display = 'none';
                }
            });

            // Update selected date text when a date is chosen
            departureDateInput.addEventListener('change', function () {
                const selectedDate = departureDateInput.value;
                selectedDateText.textContent = `Selected Date: ${selectedDate}`;
            });
        });
    </script>


    {{--
    <script>
        // The script is already wrapped in DOMContentLoaded, which is good practice.
        document.addEventListener('DOMContentLoaded', function () {
            // --- 1. Get DOM Elements ---
            const calendarTrigger = document.getElementById('calendarTrigger');
            const departureDateInput = document.getElementById('departure_date');
            const selectedDateText = document.getElementById('selectedDate');

            // --- 2. CRITICAL FIX: Check if the element exists ---
            // The error happens here. We must ensure departureDateInput is NOT null 
            if (departureDateInput) {
                // Set the min attribute of the date input to today's date
                const today = new Date();
                // Format as YYYY-MM-DD for the date input's 'min' attribute
                const formattedDate = today.toISOString().split('T')[0];

                // This line will now only run if departureDateInput is found
                departureDateInput.setAttribute('min', formattedDate);
            } else {
                // Optional: Log an error to the console to help debug the missing HTML element
                console.error("Error: Could not find element with ID 'departure_date'. Check your HTML.");
            }

            // --- 3. Event Listeners (Also add null checks for safety) ---
            if (calendarTrigger && departureDateInput) {
                // Toggle visibility of the date input on clicking the calendar trigger
                calendarTrigger.addEventListener('click', function () {
                    // Toggle display between 'none' and 'block'
                    departureDateInput.style.display =
                        (departureDateInput.style.display === 'none' || departureDateInput.style.display === '') ? 'block' : 'none';
                });
            }

            if (departureDateInput && selectedDateText) {
                // Update selected date text when a date is chosen
                departureDateInput.addEventListener('change', function () {
                    const selectedDate = departureDateInput.value;
                    selectedDateText.textContent = `Selected Date: ${selectedDate}`;
                });
            }
        });
    </script> --}}

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />



    @php
        // Helper function to extract YouTube ID (from your original code)
        function getYoutubeId($urlOrId)
        {
            preg_match("/(?:v=|\/)([a-zA-Z0-9_-]{11})/", $urlOrId, $matches);
            return $matches[1] ?? $urlOrId;
        }

        // 1. Get all eligible slides
        $allSlides = \App\Models\TestimonialModel::where('SLIDE_STATUS', 1)
            ->orderBy('SLIDE_SORTING', 'asc')
            ->get();

        // 2. Filter the slides to keep ONLY those with a valid video ID
        $videoSlides = $allSlides->filter(function ($slide) {
            // We call the helper function to ensure it's a valid ID, not just a full URL
            return !empty(getYoutubeId($slide->{\App\Models\TestimonialModel::YOUTUBE_LINK}));
        });
    @endphp

    {{-- 3. Conditional Rendering: Only show the entire section if video slides exist --}}
    @if($videoSlides->isNotEmpty())
        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="text-uppercase fw-bold" style="color:#F1C40F">Traveler Insights</span>
                <h2 class="fw-bold">Hear From Our Happy Travelers</h2>
            </div>

            <div class="guest-slider">
                {{-- 4. Loop only through the filtered video slides --}}
                @foreach($videoSlides as $slide)
                    @php
                        $videoId = getYoutubeId($slide->{\App\Models\TestimonialModel::YOUTUBE_LINK});
                        $youtubeThumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";

                    @endphp

                    <div class="card guest-card">
                        <div class="ratio ratio-16x9 position-relative">

                            {{-- Placeholder Image (used as the video thumbnail) --}}
                            <img src="{{ $youtubeThumbnailUrl }}" class="card-img-top video-poster"
                                alt="{{ $slide->{\App\Models\TestimonialModel::HEADING_MIDDLE} }}">

                            {{-- Iframe for the video, hidden by default (Crucial for image display) --}}
                            <iframe class="video-frame"
                                src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=0&mute=1&loop=1&playlist={{ $videoId }}"
                                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                            </iframe>

                            {{-- Play Button --}}
                            <div class="play-button" style="cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    class="bi bi-play-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11.596 8.697l-6.363 3.692A.5.5 0 0 1 4 12.92V3.08a.5.5 0 0 1 .733-.442l6.363 3.692a.5.5 0 0 1 0 .868z" />
                                </svg>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $slide->{\App\Models\TestimonialModel::HEADING_MIDDLE} }}</h5>
                            <p class="card-text text-muted small">{{ $slide->{\App\Models\TestimonialModel::HEADING_BOTTOM} }}</p>
                            {{-- Close Button (will be hidden by default via JS/CSS) --}}
                            <button class="btn btn-outline-secondary btn-sm close-video-btn" style="display:none;">Close
                                Video</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    <!-- jQuery & Slick JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
        const slider = $('.guest-slider');

        slider.slick({
            dots: true,
            infinite: true,
            speed: 600,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3500,
            pauseOnHover: true,
            responsive: [
                { breakpoint: 992, settings: { slidesToShow: 2 } },
                { breakpoint: 576, settings: { slidesToShow: 1 } }
            ]
        });

        $(document).on('click', '.play-button', function (e) {
            e.stopPropagation();
            $('.video-frame').each(function () {
                const baseSrc = $(this).attr('src').split('?')[0];
                $(this).hide().attr('src', baseSrc);
                $(this).closest('.guest-card').find('img').show();
                $(this).closest('.guest-card').find('.play-button').show();
                $(this).closest('.guest-card').find('.close-video-btn').hide();
            });

            const card = $(this).closest('.guest-card');
            const iframe = card.find('.video-frame');
            const baseSrc = iframe.attr('src').split('?')[0];

            card.find('img').hide();
            iframe.show().attr('src', baseSrc + "?autoplay=1&mute=1");
            $(this).hide();
            card.find('.close-video-btn').show();
            slider.slick('slickPause');
        });

        $(document).on('click', '.close-video-btn', function () {
            const card = $(this).closest('.guest-card');
            const iframe = card.find('.video-frame');
            const baseSrc = iframe.attr('src').split('?')[0];

            iframe.hide().attr('src', baseSrc);
            card.find('img').show();
            card.find('.play-button').show();
            $(this).hide();
            slider.slick('slickPlay');
        });
    </script>



    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Blog Slider -->
    <div id="blogSlider" class="swiper container" data-aos="fade-up">
        <h2 style="margin-bottom:50px">Our Blog</h2>
        <div id="blogWrapper" class="swiper-wrapper">
            <!-- Start of the Blade foreach loop -->
            @foreach($blogs as $blog)
                <div class="swiper-slide">
                    <!-- Updated the href to use the route() helper with the blog's slug -->
                    <a href="{{ route('blogDetailpage', ['slug' => $blog->slug]) }}" class="block no-underline text-current">
                        <div id="blogCard-{{ $blog->id }}" class="blog-card">
                            <div class="blog-image-container">
                                <!-- The src attribute now uses the asset() helper to get the full public URL -->
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" />
                                <div class="image-overlay">
                                    <div class="read-more-center">
                                        <i class="bi bi-arrow-right"></i>
                                        <span>Read More</span>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-content">
                                <div class="content-header">
                                    <span class="blog-category">{{ $blog->blog_category ?? 'Travel' }}</span>
                                    <span class="blog-date"> •
                                        {{ \Carbon\Carbon::parse($blog->blog_date)->format('Y-m-d') }}</span>
                                </div>
                                <h3 class="blog-title">{{ $blog->title }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <!-- End of the Blade foreach loop -->
        </div>

        <!-- Navigation & Pagination -->
        <div id="blogPagination" class="swiper-pagination"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        const blogSwiper = new Swiper("#blogSlider", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: "#blogPagination",
                clickable: true,
            },
            navigation: {
                nextEl: "#blogNext",
                prevEl: "#blogPrev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
    </script>







    <section class="newsletter-section">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-12" style="padding:0px;margin:0px;">
                    <div class="newsletter-card">
                        <h2 class="newsletter-title" style="font-size:40px;">Subscribe to Our Newsletter</h2>
                        <p class="newsletter-subtitle">Get the latest updates, straight to your inbox.</p>

                        <div id="alertContainer"></div>

                        <form id="newsletterForm">
                            @csrf

                            <div class="d-flex flex-column flex-md-row align-items-stretch gap-2 mb-3">
                                <div class="flex form-group" style="">
                                    <input style="width:400px; !important" type="email" class="form-control" id="email_id"
                                        name="email_id" placeholder="Your email" required>
                                    <div class="invalid-feedback" id="emailError"></div>
                                </div>

                                <div class="d-flex align-items-center flex-shrink-0 gap-2">
                                    <div class="captcha-container text-center rounded-3 p-0"
                                        style="width: 120px; height: 50px;">
                                        <div class="captcha-display" id="captchaDisplay">
                                            {!! captcha_img('default') !!}
                                        </div>
                                    </div>

                                    <button type="button" class="captcha-refresh flex-shrink-0" id="refreshCaptcha">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>

                                <div class="flex-shrink-0 form-group">
                                    <input type="text" style="" class="form-control text-center" id="captcha" name="captcha"
                                        placeholder="Code" required autocomplete="off">
                                    <div class="invalid-feedback" id="captchaError"></div>
                                </div>

                                <div class="flex-shrink-0 form-group">
                                    <button type="submit" class="btn  btn-subscribe h-100"
                                        style="min-width: 120px;background:#F1C40F">
                                        <div class="btn-content">
                                            <span class="loading spinner-border spinner-border-sm me-2"
                                                role="status"></span>
                                            <i class="fas fa-paper-plane me-2" id="submitIcon"></i>
                                            <span id="submitText">Subscribe</span>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <p class="privacy-text">
                                <i class="fas fa-shield-alt me-1"></i>
                                We respect your privacy. Unsubscribe anytime.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // CSRF Token Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Refresh Captcha - FIXED VERSION
            $('#refreshCaptcha').on('click', function (e) {
                e.preventDefault();
                refreshCaptcha();
            });

            function refreshCaptcha() {
                const refreshBtn = $('#refreshCaptcha');
                const icon = refreshBtn.find('i');

                // Add loading state
                icon.addClass('fa-spin');
                refreshBtn.prop('disabled', true);

                // AJAX call to refresh captcha
                $.ajax({
                    url: "{{ route('refreshCaptcha') }}", // Using your defined route
                    type: 'GET',
                    // Remove dataType to see raw response first
                    success: function (response, textStatus, xhr) {
                        console.log('Raw response:', response);
                        console.log('Response type:', typeof response);
                        console.log('Content-Type:', xhr.getResponseHeader('Content-Type'));
                        console.log('Status:', xhr.status);

                        // Try to handle different response formats
                        let parsedResponse;

                        if (typeof response === 'string') {
                            try {
                                parsedResponse = JSON.parse(response);
                                console.log('Parsed JSON:', parsedResponse);
                            } catch (e) {
                                console.error('Failed to parse JSON:', e);
                                // If it's HTML (captcha image), use it directly
                                if (response.includes('<img') || response.includes('captcha')) {
                                    console.log('Response appears to be HTML captcha');
                                    $('#captchaDisplay').html(response);
                                    $('#captcha').val('').removeClass('is-invalid');
                                    $('#captchaError').text('');
                                    return;
                                } else {
                                    showAlert('Invalid response format received.', 'danger');
                                    return;
                                }
                            }
                        } else {
                            parsedResponse = response;
                        }

                        // Handle JSON response - Your backend returns {status: true, data: "url", message: "Success"}
                        if (parsedResponse && parsedResponse.status && parsedResponse.data) {
                            console.log('Valid response with captcha URL');
                            // Create img element with the captcha URL
                            const captchaImg = `<img src="${parsedResponse.data}" alt="Captcha" style="width: 100%; height: 100%; object-fit: cover;">`;
                            $('#captchaDisplay').html(captchaImg);
                            $('#captcha').val('').removeClass('is-invalid');
                            $('#captchaError').text('');
                        } else if (parsedResponse && parsedResponse.success && parsedResponse.captcha) {
                            console.log('Alternative JSON response with captcha HTML');
                            $('#captchaDisplay').html(parsedResponse.captcha);
                            $('#captcha').val('').removeClass('is-invalid');
                            $('#captchaError').text('');
                        } else if (parsedResponse && parsedResponse.captcha) {
                            // Sometimes success field might be missing
                            console.log('JSON response with captcha (no success field)');
                            $('#captchaDisplay').html(parsedResponse.captcha);
                            $('#captcha').val('').removeClass('is-invalid');
                            $('#captchaError').text('');
                        } else {
                            console.error('Response structure:', parsedResponse);
                            showAlert('Invalid response structure. Check console for details.', 'danger');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error Details:', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            responseText: xhr.responseText,
                            error: error,
                            readyState: xhr.readyState,
                            contentType: xhr.getResponseHeader('Content-Type')
                        });

                        let errorMessage = 'Failed to refresh captcha. Please try again.';

                        if (xhr.status === 0) {
                            errorMessage = 'Network error. Please check your connection.';
                        } else if (xhr.status === 404) {
                            errorMessage = 'Captcha refresh endpoint not found. Please check your routes.';
                        } else if (xhr.status === 500) {
                            errorMessage = 'Server error occurred while refreshing captcha.';
                        } else if (xhr.status === 419) {
                            errorMessage = 'Session expired. Please refresh the page.';
                        } else if (xhr.status === 403) {
                            errorMessage = 'Access denied. Please check your permissions.';
                        }

                        showAlert(errorMessage, 'danger');
                    },
                    complete: function () {
                        // Remove loading state
                        icon.removeClass('fa-spin');
                        refreshBtn.prop('disabled', false);
                    }
                });
            }

            // Form Submission
            $('#newsletterForm').on('submit', function (e) {
                e.preventDefault();

                // Clear previous errors
                clearErrors();
                clearAlerts();

                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const loading = submitBtn.find('.loading');
                const submitText = $('#submitText');
                const submitIcon = $('#submitIcon');

                // Show loading state
                setLoadingState(true, submitBtn, loading, submitText, submitIcon);

                // Replace with your actual newsletter subscription route
                $.ajax({
                    url: "{{ route('subscribeNewsLetter') }}", // Your newsletter subscription route
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        console.log('Newsletter subscription response:', response);

                        if (response.status || response.success) {
                            showAlert(response.message || 'Successfully subscribed to newsletter!', 'success');
                            form[0].reset();
                            refreshCaptcha();
                        } else {
                            showAlert(response.message || 'Subscription failed. Please try again.', 'danger');
                            refreshCaptcha();
                        }
                    },
                    error: function (xhr) {
                        console.error('Newsletter subscription error:', xhr);

                        if (xhr.status === 422) {
                            // Validation errors
                            const errors = xhr.responseJSON?.errors || {};
                            handleValidationErrors(errors);
                        } else if (xhr.responseJSON?.message) {
                            showAlert(xhr.responseJSON.message, 'danger');
                        } else {
                            showAlert('An unexpected error occurred. Please try again.', 'danger');
                        }
                        refreshCaptcha();
                    },
                    complete: function () {
                        setLoadingState(false, submitBtn, loading, submitText, submitIcon);
                    }
                });
            });

            // Helper functions
            function setLoadingState(isLoading, btn, loading, text, icon) {
                if (isLoading) {
                    loading.addClass('show');
                    text.text('Subscribing...');
                    icon.hide();
                    btn.prop('disabled', true);
                } else {
                    loading.removeClass('show');
                    text.text('Subscribe');
                    icon.show();
                    btn.prop('disabled', false);
                }
            }

            function showAlert(message, type) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

                const alertHtml = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <i class="fas ${iconClass} me-2"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ${message}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                `;

                $('#alertContainer').html(alertHtml);

                if (type === 'success') {
                    setTimeout(function () {
                        $('.alert').alert('close');
                    }, 5000);
                }
            }

            function handleValidationErrors(errors) {
                if (errors.email_id) {
                    $('#email_id').addClass('is-invalid');
                    $('#emailError').text(errors.email_id[0]);
                }

                if (errors.captcha) {
                    $('#captcha').addClass('is-invalid');
                    $('#captchaError').text(errors.captcha[0]);
                }

                const firstError = Object.values(errors)[0][0];
                showAlert(firstError, 'danger');
            }

            function clearErrors() {
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').text('');
            }

            function clearAlerts() {
                $('#alertContainer').html('');
            }

            // Remove validation errors when user starts typing
            $('#email_id, #captcha').on('input', function () {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });

            // Focus on email input
            // $('#email_id').focus();
            $('#email_id').focus({ preventScroll: true });
        });
    </script>




    <!-- Modal -->
    <div class="modal fade" id="vacationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">

                <!-- CLOSE BUTTON - FIXED & ALWAYS CLICKABLE -->
                <button type="button" class="btn-close position-absolute top-0 end-0 m-4" data-bs-dismiss="modal"
                    aria-label="Close" style="z-index: 99999 !important;">
                </button>

                <div class="modal-body p-0">
                    <div class="row g-0">
                        <!-- Left Sidebar -->
                        <div class="col-lg-5">
                            <div class="sidebar-info h-100 d-flex flex-column justify-content-start">
                                <h5 class="fw-bold mb-4">How It Works</h5>
                                <div class="d-flex gap-3 mb-4">
                                    <div class="step-number">1</div>
                                    <div>
                                        <p class="mb-0 small">Tell us details of your holiday plan.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mb-4">
                                    <div class="step-number">2</div>
                                    <div>
                                        <p class="mb-0 small">Get multiple quotes from expert agents.</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 mb-4">
                                    <div class="step-number">3</div>
                                    <div>
                                        <p class="mb-0 small">Select & book best deal.</p>
                                    </div>
                                </div>

                                <hr class="my-4 opacity-25">
                                <h6 class="fw-bold mb-3">Satisfied Customers</h6>
                                <div class="d-flex justify-content-between mb-2"><span>odishavoyages</span><span
                                        class="stat-badge">Verified</span></div>
                                <div class="d-flex justify-content-between mb-2"><span>Stringent</span><span
                                        class="stat-badge">Quality Control</span></div>
                                <div class="d-flex justify-content-between mb-3"><span>Destinations</span><span
                                        class="stat-badge">45+</span></div>

                                <hr class="my-4 opacity-25">
                                <div class="text-center mt-auto">
                                    <p class="mb-2"><i class="fas fa-phone-alt me-2"></i>Call Us for details</p>
                                    @if(isset($webElements['Phone_number1']))
                                        <p style="color:black;font-size:1.2rem;font-weight:bold">
                                            <i class="fas fa-phone"></i>
                                            <a href="tel:{!! $webElements['Phone_number1'] !!}"
                                                style="color:black;text-decoration:none">
                                                {!! $webElements['Phone_number1'] !!}
                                            </a>
                                        </p>
                                    @else
                                        <p style="color:black;font-size:1.2rem;font-weight:bold">
                                            <i class="fas fa-phone"></i>
                                            <a style="color:black;text-decoration:none" href="tel:9899088497">9899088497</a>
                                        </p>
                                    @endif
                                        
                                    <div class="mt-3">
                                        <a href="{!! $webElements["whatsapp_footer_link"] ?? '#' !!}"
                                            target="_blank" aria-label="WhatsApp">
                                            <img src="{{ asset('./assets/images/whatsapp.png') }}" alt="WhatsApp"
                                                height="50" width="50">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Form -->
                        <div class="col-lg-7 bg-white">
                            <div class="modal-custom-header pt-5 px-4">
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <span style="font-size: 3rem;">🗺️</span>
                                    <div>
                                        <h4 class="mb-1 fw-bold">Want to Go on A Memorable Vacation?</h4>
                                        <p class="mb-0 text-muted">Provide Your Details to Get Best Holiday Deals</p>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 pb-5">
                                <form id="vacationForm" method="POST">
                                    @csrf
                                    <div class="form-group " style="background-color: white;">
                                        <i class="fa fa-user"></i>
                                        <input type="text" name="name" placeholder="Your Name *" required>
                                    </div>
                                    <div class="form-group" style="background-color: white;">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Your Email *" required>
                                    </div>
                                    <div class="form-group" style="background-color: white;">
                                        <i class="fa fa-phone"></i>
                                        <input type="tel" name="phone" placeholder="Your Phone *" required>
                                    </div>
                                    <div class="form-group" style="background-color: white;">
                                        <i class="fa fa-comment"></i>
                                        <textarea name="message" placeholder="Tell us about your travel plans..." rows="3"
                                            required></textarea>
                                    </div>

                                    <button type="submit" class="w-100 py-3 border-0 rounded-2 fw-bold text-black"
                                        style="background:#F1C40F; font-size:18px;">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Auto-open modal after 200ms
            setTimeout(() => {
                new bootstrap.Modal(document.getElementById('vacationModal'), {
                    backdrop: 'static',
                    keyboard: false
                }).show();
            }, 10000);

            // Form Submission
            document.getElementById('vacationForm').addEventListener('submit', async function (e) {
                e.preventDefault();
                const btn = this.querySelector('button[type="submit"]');
                const originalText = btn.innerText;
                btn.disabled = true;
                btn.innerText = "Submitting...";

                const formData = new FormData(this);

                try {
                    const res = await fetch("{{ route('query.submit') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                        }
                    });

                    const data = await res.json();

                    if (res.ok && data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thank You!',
                            text: data.message || 'We will contact you shortly!',
                            toast: true,
                            position: 'top-end',
                            timer: 4000,
                            showConfirmButton: false
                        });
                        this.reset();
                        setTimeout(() => {
                            bootstrap.Modal.getInstance(document.getElementById('vacationModal')).hide();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Something went wrong');
                    }
                } catch (err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: err.message || 'Please try again later',
                        toast: true,
                        position: 'top-end',
                        timer: 5000,
                        showConfirmButton: false
                    });
                } finally {
                    btn.disabled = false;
                    btn.innerText = originalText;
                }
            });
        });
    </script>

@endsection