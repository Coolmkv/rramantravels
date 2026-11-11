@extends('layouts.webSite')

@section('title', 'Services')
@section('content')   


<!-- Tour Grid Area start -->
<!-- <div class="default-content pt-120 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3" data-aos="fade-up">
                <h2 class="text-center" data-aos="fade-up"> Our Services</h2>
                <p class="text-center p-2">{!! $our_services_subheading ?? 'We provide a wide range of services that cater to both
                    individual travelers and corporate clients. Here’s a glimpse of what we offer:' !!}</p>
            </div>
            <div class="service-icon-content">
                <div class="icon-content">
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-1.png" alt=""></div>
                        <p class="text-center">Flight</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-2.png" alt=""></div>
                        <p class="text-center">Hotel</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-3.png" alt=""></div>
                        <p class="text-center">Cab</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-4.png" alt=""></div>
                        <p class="text-center">Train</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-5.png" alt=""></div>
                        <p class="text-center">Bus</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-6.png" alt=""></div>
                        <p class="text-center">Package</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-7.png" alt=""></div>
                        <p class="text-center">Visa</p>
                    </div>
                    <div class="service-icon">
                        <div class="icon"><img src="./assets/images/service-8.png" alt=""></div>
                        <p class="text-center">Passport</p>
                    </div>
                </div>
            </div>
            <div class="midd-content">
                @if (!empty($ourServices) && count($ourServices))
                @foreach ($ourServices as $item)
                    <div class="services-container">
                        <div class="left-item" data-aos="fade-up"data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{$item->service_image}}" alt="service-img">
                        </div>
                        <div class="right-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h4>{{$item->service_name}}</h4>
                            <p>{!!$item->service_details!!}</p>
                            <a href="{{ route('contactUs') }}"><p class="btn enquireNow">
                                Enquiry Now</p></a>
                        </div>
                    </div>
                @endforeach
                @else -->
                <!-- <div class="services-container">
                    <div class="left-item" data-aos="fade-up">
                        <img src="./assets/images/corporate-tours.jpg" alt="service-img">
                    </div>
                    <div class="right-item" data-aos="fade-up">
                        <h4>Corporate Travel Solutions</h4>
                        <p>Travel for businesses can be complex and time-consuming. We are there to make your travel
                            process
                            more enjoyable by streamlining its processing for companies of all sizes.We take care of
                            every detail of corporate travel-from flight booking to accompanying them at hotels
                            and even arranging ground transport for them. Our core objective is to make the travel
                            experience
                            for their employees efficient and worthwhile.</p>
                            <a href="{{ route('contactUs') }}"><p class="btn enquireNow">
                            Enquiry Now</p></a>
                    </div>
                    
                </div> -->
                    <!-- <div class="services-container">
                        <div class="left-item" data-aos="fade-up"data-aos-duration="1500" data-aos-offset="50">
                            <img src="./assets/images/Leadership-and-Management-Skill-Programs-1.jpg" alt="service-img">
                        </div>
                        <div class="right-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h4>Custom Travel Packages</h4>
                            <p>Custom Travel Packages is one of the services we put forward, showing our adaptation to every
                                client&#39;s differing interests, preferences, and budgets. We know that any customer may
                                want a
                                romantic getaway, a family vacation, or a solo adventure. We work closely with the client so
                                we
                                come up with a tailor-made itinerary that reflects all his or her desires.</p>
                            <a href="{{ route('contactUs') }}"><p class="btn enquireNow">
                                Enquiry Now</p></a>
                        </div>
                    </div>
                    <div class="services-container">
                        <div class="left-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <img src="./assets/images/apartment-villa.jpg" alt="service-img">
                        </div>
                        <div class="right-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h4>Flight and Hotel Bookings</h4>
                            <p>In the present scenario, it can be very overwhelming to find the right flights and
                                accommodation
                                given the hundreds of choices out there. At Trip Closure, we simplify the Flight and Hotel
                                Booking
                                process by giving you varied options that just fit your needs. We have a large airline
                                network and hotel chains, so we can find the best rates and good availability
                                for your travel dates.</p>
                                <a href="{{ route('contactUs') }}"><p class="btn enquireNow">
                                Enquiry Now</p></a>
                        </div>
                    </div>
                    <div class="services-container">
                        <div class="left-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <img src="./assets/images/adventure-tours.jpg" alt="service-img">
                        </div>
                        <div class="right-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h4>Visa and Travel</h4>
                            <p>There is quite a mess in visa applications and adequate travel insurance,
                                especially with international travel. Our Visa and Travel Insurance service takes away all
                                the
                                confusion. Our team, with ample experience, will help you fill out the visa application
                                so that you prepare and present all the necessary documentation and information to
                                successfully
                                enter your destination.</p>
                                <a href="{{ route('contactUs') }}"><p class="btn enquireNow">
                                Enquiry Now</p></a>
                        </div>
                    </div>
                    <div class="services-container">
                        <div class="left-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <img src="./assets/images/international-conventions.jpg" alt="service-img">
                        </div>
                        <div class="right-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h4>Local Tours and Activities</h4>
                            <p>Traveling is barely imaginable without you enjoying the best of what a place has to give
                                through local
                                tours and activities. Indeed, we regard this as one of the indispensable methods of gaining
                                a more
                                meaningful connection with the local culture and traditions whenever you are in a location</p>
                                <a href="{{ route('contactUs') }}"><p class="btn enquireNow">
                                Enquiry Now</p></a>
                        </div>
                    </div> 
                @endif


            </div>

        </div>
    </div> -->
<!-- Tour Grid Area end -->

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
            text-align: center;
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

        .default-content {
            padding: 120px 0 24px;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            padding-top:0px;
        }

        .default-content::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="10" cy="50" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="90" cy="30" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .custom-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            position: relative;
            z-index: 1;
        }

        .services-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 40px;
            gap: 30px;
            opacity: 1;
            transform: translateY(0px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .services-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        /* Odd: image left, Even: image right */
        .services-container.odd { flex-direction: row; }
        .services-container.even { flex-direction: row-reverse; }

        .left-item {
            flex: 0 0 300px;
        }

        .left-item img {
            width: 100%;
            max-width: 500px;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, filter 0.3s ease;
        }
        
        .services-container:hover .left-item img {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        .right-item { 
            flex: 1; 
            padding: 20px;
        }
        
        .right-item h4 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        
        .right-item p {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #666;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            background: #F1C40F !important;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(241, 196, 15, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 15px 30px rgba(241, 196, 15, 0.4);
        }

        /* Floating background shapes */
        .floating-element { 
            position: absolute; 
            pointer-events: none; 
            opacity: 0.1; 
        }
        
        .floating-circle { 
            width: 100px; 
            height: 100px; 
            border-radius: 50%; 
            background: linear-gradient(135deg, #667eea, #764ba2); 
            animation: float 6s ease-in-out infinite; 
            top: 20%; 
            left: 10%;
        }
        
        .floating-triangle { 
            width: 0; 
            height: 0; 
            border-left: 50px solid transparent; 
            border-right: 50px solid transparent; 
            border-bottom: 86px solid #667eea; 
            animation: float 8s ease-in-out infinite reverse; 
            top: 60%; 
            right: 15%;
        }
        
        .floating-square { 
            width: 80px; 
            height: 80px; 
            background: linear-gradient(135deg, #764ba2, #667eea); 
            transform: rotate(45deg); 
            animation: float 10s ease-in-out infinite; 
            top: 40%; 
            right: 5%;
        }

        @keyframes float {
            0%,100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .right-item h4 { font-size: 1.6rem; }
            .right-item p { font-size: 1rem; }
            .left-item { 
                flex: 0 0 250px; 
            }
            .left-item img {
                height: 200px;
            }
        }
        
        @media (max-width: 768px) {
            .services-container { 
                 text-align: center; 
            }
            
            .services-container.odd,
            .services-container.even { 
                flex-direction: column; 
            }
            
            .left-item { 
                flex: none; 
                margin-bottom: 20px;
                width: 100%;
            }
            
            .left-item img { 
                width: 100%;
                height: 220px;
                max-width: none;
                object-fit: cover;
            }
            
            .right-item h4 { font-size: 1.4rem; }
            .btn { width: 100%; }
        }
        
        @media (max-width: 480px) {
            h2 { font-size: 2rem !important; }
            .right-item h4 { font-size: 1.2rem; }
            .right-item p { font-size: 0.9rem; }
            .btn { font-size: 0.9rem; padding: 10px 20px; }
            .default-content { padding: 80px 0 24px; }
            .services-container {  margin-bottom: 30px; }
            
            .left-item img {
                height: 180px;
                width: 100%;
            }
        }

        @media (max-width: 360px) {
            .left-item img {
                height: 160px;
            }
            
            .services-container {
                padding: 12px;
                margin-bottom: 25px;
            }
            
            .right-item {
                padding: 15px;
            }
            
            h2 { 
                font-size: 1.8rem !important; 
                margin-bottom: 30px;
            }
        }

        /* Animation for scroll reveal effect */
        .services-container {
            opacity: 0;
            transform: translateY(50px);
            animation: slideUp 0.6s ease forwards;
        }

        .services-container:nth-child(2) { animation-delay: 0.2s; }
        .services-container:nth-child(3) { animation-delay: 0.4s; }
        .services-container:nth-child(4) { animation-delay: 0.6s; }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome for icons -->
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
        margin-bottom: 15px;
    }

    /* Form Group with Box & Icon */
    .form-group {
        position: relative;
        flex: 1;
        min-width: 150px;
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
        padding: 12px 12px 12px 40px; /* left padding for icon */
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        font-size: 1rem;
        font-weight: 500;
        background: #fafafa;
        transition: 0.3s;
    }

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

<section class="pt-150 pb-3">
    <div class="">
            <img src="./assets/images/imageabout1.jpg" style="width:100%;max-height:250px" alt="Gallery Banner">
        </div>
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
    
    <div class="default-content ">
        <!-- Floating elements -->
        <div class="floating-element floating-circle" style="top: 10%; left: 5%;"></div>
        <div class="floating-element floating-triangle" style="top: 20%; right: 10%;"></div>
        <div class="floating-element floating-square" style="bottom: 20%; left: 8%;"></div>
        <div class="floating-element floating-circle" style="bottom: 30%; right: 5%;"></div>

        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center" style="margin-top:60px">Our Services</h2>
                <p class="text-center p-2">We provide a wide range of services that cater to both individual travelers and corporate clients. Here's a glimpse of what we offer:</p>
            </div>
            
            <div class="midd-content">
                <!-- Service 1: Corporate Travel Solutions (Image Left) -->
                @foreach ($ourServices as $item)
               
                <div class="services-container">
                    <div class="left-item">
                        <img src="{{$item->service_image}}" alt="service-img">
                    </div>
                    <div class="right-item">
                        <h4>{{$item->service_name}}</h4>
                        <p>{!!$item->service_details!!}</p>
                         <a href="{{ route('contactUs') }}"><p class="btn enquireNow">
                                Enquiry Now</p></a>
                    </div>
                </div>
                    @endforeach
              

               
               
                
                <!-- Service 5: Local Tours and Activities (Image Left) -->
                </div>
        </div>
    </div>

    <script>
        // Add scroll animations
        function addScrollAnimation() {
            const containers = document.querySelectorAll('.services-container');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            containers.forEach(container => {
                observer.observe(container);
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            addScrollAnimation();
        });

        // Add smooth scrolling for enquiry buttons
        document.querySelectorAll('.enquireNow').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                // Add ripple effect
                const ripple = document.createElement('span');
                const rect = button.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                button.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>

<!-- Newsletter Area start -->
<!-- <section class="newsletter-three bgc-primary py-100 rel z-1"
    style="background-image: url(assets/images/newsletter/newsletter-bg-lines.png);">
    <div class="container container-1500">
        <div class="row">
            <div class="col-lg-6">
                <div class="newsletter-content-part text-white rmb-55" data-aos="zoom-in-right" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="section-title counter-text-wrap mb-45">
                        <h2>Subscribe Our Newsletter to Get more offer & Tips</h2>
                        <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most
                            popular experience you’ll remember</p>
                    </div>
                    <form class="newsletter-form mb-15" action="#">
                        <input id="news-email" type="email" placeholder="Email Address" required>
                        <button type="submit" class="theme-btn bgc-secondary style-two">
                            <span data-hover="Subscribe">Subscribe</span>
                            <i class="fal fa-arrow-right"></i>
                        </button>
                    </form>
                    <p>No credit card requirement. No commitments</p>
                </div>
                <div class="newsletter-bg-image" data-aos="zoom-in-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <img src="assets/images/newsletter/newsletter-bg-image.png" alt="Newsletter">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newsletter-image-part bgs-cover"
                    style="background-image: url(assets/images/newsletter/newsletter-two-right.jpg);"
                    data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50"></div>
            </div>
        </div>
    </div>
</section> -->
<!-- Newsletter Area end -->
 <style>
    h2{
        color:#022f5d;
    }
    .services-container:nth-child(2n+1) > div:first-child {
    order: 1;
}
.left-item {
    flex-shrink: 0; /* prevents it from shrinking */
}
.left-item img {
    /* float: left; */
    margin-bottom: 20px;
    display: block;
    margin: auto;
    max-height: 350px;
    min-height: 350px;
    object-fit: cover;
    min-width: 400px;
}
 </style>
@endsection