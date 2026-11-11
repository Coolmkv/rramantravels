@extends('layouts.webSite')
@section('content')
    <!-- about-section -->
    <!-- Hero Area Start -->
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Hero Section with Video Background */
        .hero-section {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            max-height: 100vh;
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .video-background iframe {
            width: 100vw;
            height: 56.25vw;
            min-height: 100vh;
            min-width: 177.77vh;
            border: none;
            pointer-events: none;
        }

        /* Hero Content Overlay */
        .hero-content {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 95%;
            max-width: 1300px;
            z-index: 10;
            padding-bottom: 20px;
        }

        /* Form Heading inside form */
        .search-form .form-heading {
            flex-basis: 100%;
            text-align: left;
            font-size: 1.2rem;
            font-weight: bold;
            color: black;
        }

        /* Overlay form heading styling */
        .hero-content .form-heading {
            color: black;
            text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.5);
        }

        /* Search Form */
        .search-form {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border-radius: 20px;
            padding: 10px 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-group {
            display: flex;
            align-items: center;
            background: #f9f9f9;
            border-radius: 10px;
            padding: 5px 12px;
            border: 1px solid #ddd;
            flex: 1;
            min-width: 150px;
            margin-bottom: 0px !important;
        }

        .form-group i {
            margin-right: 10px;
            color: #555;
            font-size: 1rem;
        }

        .form-group input,
        .form-group textarea {
            border: none;
            outline: none;
            font-size: 1rem;
            font-weight: 600;
            padding: 8px 0;
            background: transparent;
            width: 100%;
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

        /* Responsive Below Video */
        .form-below-video {
            display: none;
            padding: 40px 20px;
            background: #f9f9f9;
            text-align: center;
        }

        .form-below-video .search-form {
            max-width: 1100px;
            margin: 0 auto;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Medium Devices (768px - 991px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .hero-content {
                display: none;
            }

            .form-below-video {
                display: block;
                padding: 20px;
            }

            .form-below-video .search-form {
                gap: 15px;
            }

            .form-below-video .form-group {
                flex: 1 1 calc(50% - 7.5px);
            }

            .form-below-video .search-btn {
                flex-basis: 100%;
            }

            .hero-section {
                max-height: 50vh;
            }
        }

        /* Small Devices (<768px) */
        @media (max-width: 767px) {
            .hero-content {
                display: none;
            }

            .form-below-video {
                display: block;
                padding: 20px;
            }

            .form-below-video .search-form {
                flex-direction: column;
                gap: 12px;
                padding: 15px;
            }

            .form-below-video .form-group {
                flex: 1 1 100%;
            }

            .form-below-video .search-btn {
                width: 100%;
            }

            .hero-section {
                max-height: 40vh;
            }
        }
    </style>

    <!-- Hero Section with Overlay Form -->
    <section class="hero-section">
        <div class="video-background">
            <iframe
                src="https://www.youtube.com/embed/_gu9BwQ1Ags?autoplay=1&mute=1&loop=1&playlist=_gu9BwQ1Ags&controls=0&modestbranding=1&fs=0&rel=0"
                title="Background Video" allow="autoplay; encrypted-media" allowfullscreen style="pointer-events: none;">
            </iframe>
        </div>

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
    <style>
        .about-us-area {
            position: relative;
            padding: 100px 0 90px;
            overflow: hidden;
        }

        .about-us-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: backgroundPulse 8s ease-in-out infinite;
        }

        @keyframes backgroundPulse {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }


        .row {}

        .col-xl-6 {
            flex: 1;
            min-width: 300px;
        }


        h2 {
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

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes underlineGlow {
            from {
                box-shadow: 0 0 5px #ff6b6b;
            }

            to {
                box-shadow: 0 0 20px #ff6b6b, 0 0 30px #ff6b6b;
            }
        }

        .about-us-content {
            position: relative;
            background: none;
        }

        .about-us-content::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;

            border-radius: 22px;
            z-index: -1;
            animation: borderGlow 3s ease-in-out infinite;
        }

        @keyframes borderGlow {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
        }

        .about-us-content p {
            color: black !important;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 30px;
            text-align: justify;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .theme-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #F1C40F;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
            position: relative;
            overflow: hidden;
        }

        .theme-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: #F1C40F;
            transition: left 0.5s ease;
        }

        .theme-btn:hover::before {
            left: 100%;
        }

        .theme-btn:hover {}

        .animated-image {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
        }

        .animated-image:hover {
            transform: translateY(-10px) rotateY(5deg);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        }

        .animated-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 20px;
            transition: transform 0.6s ease;
            filter: brightness(0.9);
        }

        .animated-image:hover img {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        /* Floating Travel Icons */
        .floating-icons {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-icon {
            position: absolute;
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.3);
            animation: floatIcon 15s infinite linear;
        }

        .floating-icon:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
            animation-duration: 12s;
        }

        .floating-icon:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: 3s;
            animation-duration: 18s;
        }

        .floating-icon:nth-child(3) {
            top: 60%;
            left: 15%;
            animation-delay: 6s;
            animation-duration: 15s;
        }

        .floating-icon:nth-child(4) {
            top: 70%;
            right: 20%;
            animation-delay: 9s;
            animation-duration: 20s;
        }

        .floating-icon:nth-child(5) {
            top: 40%;
            left: 50%;
            animation-delay: 12s;
            animation-duration: 14s;
        }

        .floating-icon:nth-child(6) {
            top: 80%;
            left: 60%;
            animation-delay: 15s;
            animation-duration: 16s;
        }

        @keyframes floatIcon {
            0% {
                transform: translateY(0px) rotate(0deg) scale(1);
                opacity: 0.3;
            }

            25% {
                transform: translateY(-30px) rotate(90deg) scale(1.2);
                opacity: 0.6;
            }

            50% {
                transform: translateY(-60px) rotate(180deg) scale(1);
                opacity: 0.8;
            }

            75% {
                transform: translateY(-30px) rotate(270deg) scale(1.1);
                opacity: 0.4;
            }

            100% {
                transform: translateY(0px) rotate(360deg) scale(1);
                opacity: 0.3;
            }
        }

        /* Travel Icons around content */
        .travel-icons {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            color: orange;
            font-size: 1.5rem;
            animation: iconBounce 3s ease-in-out infinite;
        }

        .travel-icon-1 {
            top: -30px;
            left: 50px;
            animation-delay: 0s;
        }

        .travel-icon-2 {
            top: 50%;
            right: -30px;
            animation-delay: 1s;
        }

        .travel-icon-3 {
            bottom: -30px;
            left: 30%;
            animation-delay: 2s;
        }

        @keyframes iconBounce {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.1);
            }
        }

        /* Pulsing dots */
        .pulse-dot {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            animation: pulse 2s ease-in-out infinite;
        }

        .pulse-dot-1 {
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .pulse-dot-2 {
            top: 30%;
            right: 25%;
            animation-delay: 0.5s;
        }

        .pulse-dot-3 {
            bottom: 25%;
            left: 25%;
            animation-delay: 1s;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.5);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.6;
            }
        }

        /* Stats/Features Icons */
        .features-wrapper {
            position: relative;
            margin-top: 40px;
        }

        .feature-item {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 0 20px 20px 0;
            color: white;
            font-size: 0.95rem;
            opacity: 0;
            transform: translateX(-30px);
            animation: slideInFeature 0.8s ease forwards;
        }

        .feature-item:nth-child(1) {
            animation-delay: 0.2s;
        }

        .feature-item:nth-child(2) {
            animation-delay: 0.4s;
        }

        .feature-item:nth-child(3) {
            animation-delay: 0.6s;
        }

        .feature-item:nth-child(4) {
            animation-delay: 0.8s;
        }

        @keyframes slideInFeature {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(45deg, #4ecdc4, #44a08d);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            animation: iconRotate 4s ease-in-out infinite;
        }

        @keyframes iconRotate {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(10deg);
            }

            75% {
                transform: rotate(-10deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
                text-align: center;
            }

            h2 {
                font-size: 2.5rem;
            }

            .about-us-content {
                padding: 30px 20px;
                margin-bottom: 30px;
            }

            .animated-image img {
                height: 300px;
            }

            .floating-icon {
                font-size: 1.5rem;
            }
        }

        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 4px;
        }
    </style>
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
                                <i class="fal fa-arrow-right"></i>
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



    <style>
        /* 2D Floating & 3D Hover Animation */
        .animated-image {
            perspective: 1000px;
            /* 3D perspective */
        }

        .animated-image img {
            transition: transform 0.6s ease, box-shadow 0.6s ease;
            transform-style: preserve-3d;
        }

        /* 3D tilt on hover */
        .animated-image:hover img {
            transform: rotateY(15deg) rotateX(10deg) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* 2D subtle floating animation */
        @keyframes float2D {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animated-image img {
            animation: float2D 4s ease-in-out infinite;
        }


        .destinations-area {
            position: relative;
            padding: 100px 0 70px;
            overflow: hidden;
        }

        .destinations-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            animation: backgroundFloat 20s ease-in-out infinite;
        }

        @keyframes backgroundFloat {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(0.5deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(-0.5deg);
            }
        }


        .section-title {
            text-align: center;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 1s ease forwards;
        }

        .section-title h2 {
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

        .section-title h2::after {
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

        .section-title p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes underlineGlow {
            from {
                box-shadow: 0 0 5px #ff6b8a;
            }

            to {
                box-shadow: 0 0 20px #ff6b8a, 0 0 30px #ff6b8a;
            }
        }



        .swiper-slide:nth-child(1) {
            animation-delay: 0.1s;
        }

        .swiper-slide:nth-child(2) {
            animation-delay: 0.2s;
        }

        .swiper-slide:nth-child(3) {
            animation-delay: 0.3s;
        }

        .swiper-slide:nth-child(4) {
            animation-delay: 0.4s;
        }

        .swiper-slide:nth-child(5) {
            animation-delay: 0.5s;
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .destination-item {
            position: relative;
            background: #F1C40F;
            border-radius: 20px;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            min-height: 350px;
        }

        .destination-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 107, 138, 0.1) 0%, rgba(78, 205, 196, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .destination-item:hover::before {
            opacity: 1;
        }

        .destination-item:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .destination-item .image {
            position: relative;
            height: 100%;
            overflow: hidden;
        }

        .destination-item .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            filter: brightness(0.9);
        }

        .destination-item:hover .image img {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .destination-item .image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    transparent 0%,
                    transparent 50%,
                    rgba(0, 0, 0, 0.7) 100%);
            transition: opacity 0.3s ease;
        }

        .destination-item:hover .image::after {
            opacity: 0.8;
        }

        .content {
            position: relative;
            padding: 20px;
            z-index: 2;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
        }

        .content .location {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
            transform: translateX(-20px);
            opacity: 0;
            animation: slideInLeft 0.6s ease forwards 0.8s;
        }

        .content h5 {
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 8px;
            transform: translateX(-20px);
            opacity: 0;
            animation: slideInLeft 0.6s ease forwards 1s;
        }

        .content .time {
            color: black;
            font-size: 1.2rem;
            font-weight: 500;
            transform: translateX(-20px);
            opacity: 0;
            animation: slideInLeft 0.6s ease forwards 1.2s;
        }

        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }




        .swiper-pagination-bullet-active {
            background: linear-gradient(45deg, #ff6b8a, #4ecdc4);
            transform: scale(1.2);
            box-shadow: 0 0 15px rgba(255, 107, 138, 0.6);
        }

        .view-more-buttons {
            text-align: center;
            margin-top: 50px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s ease forwards 1.5s;
        }

        .theme-btn {
            position: relative;
            background: #F1C40F;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 8px 25px rgba(255, 107, 138, 0.3);
        }

        .theme-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .theme-btn:hover::before {
            left: 100%;
        }

        .theme-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(255, 107, 138, 0.4);
        }

        .theme-btn span {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-element {
            position: absolute;
            animation: float 15s infinite linear;
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            color: orange;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            left: 80%;
            animation-delay: 0s;
            color: orange;
        }

        .floating-element:nth-child(3) {
            top: 30%;
            left: 70%;
            animation-delay: 0s;
            color: orange;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
            }

            10% {}

            90% {}

            100% {
                transform: translateY(-100px) rotate(360deg);
            }
        }

        .card-heading {
            color: white !important;
            text-decoration: none;
        }

        .destination-item a {
            text-decoration: none;
            color: inherit;
        }

        /* Pulse animation for destination items */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 107, 138, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(255, 107, 138, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 107, 138, 0);
            }
        }

        .destination-item:nth-child(odd):hover {
            animation: pulse 2s infinite;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2.5rem;
            }


            .theme-btn {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }

        /* Swiper custom styles */
        .swiper-slide {
            height: auto;
        }

        /* Loading animation */
        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .destination-item .image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.1),
                    transparent);
            transform: translateX(-100%);
            animation: shimmer 2s infinite;
            z-index: 1;
        }

        .main-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            /* Add horizontal padding */
        }

        @media (max-width: 576px) {
            .main-wrapper {
                padding: 0 10px;
            }
        }
    </style>

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
    <style>
        /* ===== RESET ===== */
        /* Small devices - Equal left and right spacing */
        @media (max-width: 767px) {
            .destinations-area .container {
                padding-left: 15px;
                padding-right: 15px;
                margin: 0 auto;
            }

            .swiper.packages {
                margin-left: 0;
                margin-right: 0;
                padding-left: 15px;
                padding-right: 15px;
            }

            .swiper.services-swiper {
                margin-left: 0;
                margin-right: 0;
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        @media (max-width: 575px) {
            .destinations-area .container {
                padding-left: 10px;
                padding-right: 10px;
            }

            .swiper.packages {
                padding-left: 10px;
                padding-right: 10px;
            }

            .swiper.services-swiper {
                padding-left: 10px;
                padding-right: 10px;

            }

        }

        /* Floating Background Emojis */
        #travel-gallery .bg-emoji-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }

        #travel-gallery .animated-emoji {
            position: absolute;
            font-size: 2rem;
            opacity: 0.08;
            animation: driftUp 25s infinite linear;
        }

        #travel-gallery .animated-emoji:nth-child(1) {
            left: 5%;
            animation-delay: 0s;
        }

        #travel-gallery .animated-emoji:nth-child(2) {
            left: 15%;
            animation-delay: -3s;
        }

        #travel-gallery .animated-emoji:nth-child(3) {
            left: 25%;
            animation-delay: -6s;
        }

        #travel-gallery .animated-emoji:nth-child(4) {
            left: 35%;
            animation-delay: -9s;
        }

        #travel-gallery .animated-emoji:nth-child(5) {
            left: 45%;
            animation-delay: -12s;
        }

        #travel-gallery .animated-emoji:nth-child(6) {
            left: 55%;
            animation-delay: -15s;
        }

        #travel-gallery .animated-emoji:nth-child(7) {
            left: 65%;
            animation-delay: -18s;
        }

        #travel-gallery .animated-emoji:nth-child(8) {
            left: 75%;
            animation-delay: -21s;
        }

        #travel-gallery .animated-emoji:nth-child(9) {
            left: 85%;
            animation-delay: -24s;
        }

        @keyframes driftUp {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10%,
            90% {
                opacity: 0.08;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Main Container */
        #travel-gallery .destination-showcase {
            padding: 60px 0;
            position: relative;
            z-index: 1;
        }

        #travel-gallery .main-wrapper {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 20px;
        }

        h2 {
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
            TEXT-ALIGN: CENTER;
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

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes underlineGlow {
            from {
                box-shadow: 0 0 5px #ff6b6b;
            }

            to {
                box-shadow: 0 0 20px #ff6b6b, 0 0 30px #ff6b6b;
            }
        }



        @keyframes pulseGlow {
            from {
                filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
            }

            to {
                filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.6));
            }
        }

        #travel-gallery .hero-heading p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Swiper Styles */
        #travel-gallery .swiper {
            width: 100%;
            padding: 20px 0 60px;
        }

        #travel-gallery .swiper-slide {
            height: auto;
        }

        /* Destination Card */
        #travel-gallery .destination-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 500px;
            position: relative;
            cursor: pointer;
            animation: cardFadeIn 0.8s ease-out;
        }

        #travel-gallery .destination-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        #travel-gallery .hero-image-wrap {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        #travel-gallery .hero-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s ease;
        }

        #travel-gallery .destination-card:hover .hero-image-wrap img {
            transform: scale(1.1);
        }

        /* Location Badges */
        #travel-gallery .badge-container {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            gap: 8px;
            z-index: 2;
        }

        #travel-gallery .location-badge {
            background: rgba(255, 255, 255, 0.9);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #333;
        }

        #travel-gallery .destination-card:hover .location-badge {
            background: rgba(255, 165, 0, 0.9);
            color: white;
        }

        /* Name Overlay */
        #travel-gallery .name-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(255, 165, 0, 0.85));
            padding: 30px 20px 20px;
            opacity: 0;
            transform: translateY(100%);
            transition: all 0.4s ease;
        }

        #travel-gallery .name-overlay h3 {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        #travel-gallery .destination-card:hover .name-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        /* Info Section */
        #travel-gallery .info-section {
            padding: 25px;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #travel-gallery .price-current {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-right: 10px;
        }

        #travel-gallery .price-original {
            font-size: 1.2rem;
            color: #7f8c8d;
            text-decoration: line-through;
        }

        #travel-gallery .discount-amount {
            color: #e74c3c;
            font-weight: 600;
        }

        #travel-gallery .trip-duration {
            color: #7f8c8d;
            font-size: 1rem;
        }

        #travel-gallery .action-button {
            background: #F1C40F;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
        }

        /* Swiper Navigation */
        #travel-gallery .swiper-button-next,
        #travel-gallery .swiper-button-prev {
            color: white;
            background: rgba(255, 165, 0, 0.8);
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            #travel-gallery .swiper-slide {
                width: 50%;
            }
        }

        @media (max-width: 768px) {
            #travel-gallery .swiper-slide {
                width: 100%;
            }

            #travel-gallery .destination-card {
                height: 450px;
            }

            #travel-gallery .hero-image-wrap {
                height: 250px;
            }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>



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
    <style>
        :root {
            --primary-orange: #FF6B35;
            --secondary-orange: #FF8C42;
            --light-orange: #FFF4F0;
            --dark-orange: #E55A2B;
            --gradient-orange: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
            --shadow-color: rgba(255, 107, 53, 0.15);
        }

        .why-choose-section {
            padding: 80px 0;
            position: relative;
        }

        .why-choose-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23FF6B35" opacity="0.02"/><circle cx="75" cy="75" r="1" fill="%23FF8C42" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }


        .section-subtitle {
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 4rem;
            font-weight: 300;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(10px);
            border: 2px solid transparent;
            box-shadow:
                0 8px 32px rgba(255, 107, 53, 0.08),
                0 4px 16px rgba(0, 0, 0, 0.04),
                0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: #B71C1C;

            transition: left 0.5s ease;
            z-index: -1;
            opacity: 0;
        }

        .feature-card:hover::before {
            left: 0;
            opacity: 1;
        }

        .feature-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow:
                0 25px 80px rgba(255, 107, 53, 0.25),
                0 15px 40px rgba(255, 140, 66, 0.15),
                0 8px 20px rgba(0, 0, 0, 0.08),
                0 0 0 1px rgba(255, 107, 53, 0.1);
            border-color: var(--primary-orange);
        }

        .feature-card:hover .card-text {
            color: white;
            transform: translateY(-5px);
        }

        .feature-card:hover .feature-number {
            color: white;
            transform: scale(1.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-orange);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            position: relative;
            transition: all 0.4s ease;
            box-shadow:
                0 12px 28px rgba(255, 107, 53, 0.3),
                0 6px 16px rgba(255, 140, 66, 0.2),
                0 3px 8px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .feature-icon::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #B71C1C;
            animation: pulse 2s infinite;
            z-index: -1;
        }

        .feature-icon i {
            font-size: 2.2rem;
            color: white;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: rotateY(180deg);
            box-shadow:
                0 20px 60px rgba(255, 255, 255, 0.4),
                0 15px 40px rgba(255, 107, 53, 0.4),
                0 8px 20px rgba(255, 140, 66, 0.3),
                inset 0 2px 4px rgba(255, 255, 255, 0.3);
        }

        .feature-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #B71C1C;

            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .card-text {
            font-size: 1.1rem;
            color: #495057;
            font-weight: 500;
            line-height: 1.6;
            transition: all 0.3s ease;
            margin: 0;
        }

        .stats-container {
            position: relative;
        }

        .stats-container .col-lg-4:nth-child(1) .feature-card {
            animation: slideInLeft 0.8s ease-out;
        }

        .stats-container .col-lg-4:nth-child(2) .feature-card {
            animation: slideInUp 0.8s ease-out 0.2s both;
        }

        .stats-container .col-lg-4:nth-child(3) .feature-card {
            animation: slideInRight 0.8s ease-out 0.4s both;
        }

        .stats-container .col-lg-4:nth-child(4) .feature-card {
            animation: slideInLeft 0.8s ease-out 0.6s both;
        }

        .stats-container .col-lg-4:nth-child(5) .feature-card {
            animation: slideInUp 0.8s ease-out 0.8s both;
        }

        .stats-container .col-lg-4:nth-child(6) .feature-card {
            animation: slideInRight 0.8s ease-out 1s both;
        }

        /* Floating particles */
        .floating-particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--gradient-orange);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            opacity: 0.3;
        }

        .particle-1 {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle-2 {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .particle-3 {
            bottom: 30%;
            left: 20%;
            animation-delay: 4s;
        }

        .particle-4 {
            top: 40%;
            right: 25%;
            animation-delay: 1s;
        }

        @keyframes expandLine {
            0% {
                width: 0;
            }

            100% {
                width: 80px;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            0% {
                transform: translateX(-50px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(50px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            0% {
                transform: translateY(50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(120deg);
            }

            66% {
                transform: translateY(10px) rotate(240deg);
            }
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2.5rem;
            }

            .feature-card {
                padding: 2rem 1.5rem;
                margin-bottom: 2rem;
            }

            .why-choose-section {
                padding: 0;
            }

            .destinations-area {
                padding: 100px 0 10px;
            }
        }
    </style>
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
    <style>
        #testimonialSlider {
            min-height: 500px;
            padding-bottom: 20px;
            margin-top: 50px
        }

        .testimonialCard {
            padding: 20px;
            margin: auto;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* ✅ Image first */
        .testimonialImg {
            width: 500px;
            height: 300px;
            margin-bottom: 20px;
            border-radius: 20px;
        }

        .testimonialText p {
            font-size: 1.2rem;
            color: #333;
            line-height: 1.6;
            margin: 0;
        }

        .testimonialText h4 {
            margin-top: 15px;
            font-weight: bold;
            color: #555;
            text-align: right;
        }

        /* ✅ Responsive */
        @media (max-width: 768px) {
            .testimonialCard {
                max-width: 90%;
                padding: 15px;
            }

            .testimonialImg {
                width: 400px;
                height: 300px;
            }

            .testimonialText p {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .testimonialImg {
                width: 400px;
                height: 200px;
            }

            .testimonialText p {
                font-size: 0.9rem;
            }
        }
    </style>
    <!-- Blog Area end -->
    <style>
        .service-view-button button {
            color: white;
        }

        .view-more-button {
            /* margin-left: 212px; */
        }

        h2 {
            color: #022f5d;
        }

        .main-slider .swiper-wrapper img {
            /* transition: 3s ease-in-out; */
            transform: scale(1.1);
            height: 650px !important;
            width: 100%;
            object-fit: cover;
            /* opacity: 1; */
        }

        .main-slider .swiper-wrapper .swiper-slide.swiper-slide-next img {
            /* transition: 10s ease-in-out; */
            /* opacity: 0.5; */
            transform: scale(1);
        }

        h5.card-heading {
            color: #fff;
            font-size: 25px;
        }

        /* .fade {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              animation: fadeInOut 4.7s infinite;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @keyframes fadeInOut {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              0% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                opacity: 0.5;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              50% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                opacity: 0.8;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              100% {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                opacity: 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */
        .text-primary {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity)) !important;
        }
    </style>

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

    <style>
        .card-title {
            color: white;
        }

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

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes underlineGlow {
            from {
                box-shadow: 0 0 5px #ff6b6b;
            }

            to {
                box-shadow: 0 0 20px #ff6b6b, 0 0 30px #ff6b6b;
            }
        }

        .guest-card {
            height: 500px;
            transition: all 0.3s ease;
            position: relative;
            margin: 0 15px;
            /* Horizontal spacing between cards */
        }

        .guest-slider {
            padding: 0 15px;
            /* Prevent clipping of margins */
        }

        .guest-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .ratio.ratio-16x9 {
            height: 350px;
            border-radius: 30px;
        }

        .card-img-top {
            height: 100%;
            object-fit: cover;
        }

        .video-frame {
            display: none;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: red;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 2;
        }

        .play-button svg {
            color: white;
        }

        .close-video-btn {
            display: none;
            margin-top: 10px;
            background: #B71C1C;
            color: white;
        }

        a {
            text-decoration: none !important;
        }

        .card-text {
            color: !important;
        }
    </style>

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

    <style>
        :root {
            --primary-orange: #ff6b35;
            --gradient-orange: linear-gradient(135deg, #ff6b35, #f7931e);
        }

        #blogSlider {
            margin: 0 auto;
            padding: 40px 0;
        }

        .blog-card {
            background: #F1C40F;
            border-radius: 12px;
            overflow: hidden;
            box-shadow:
                rgba(50, 50, 93, 0.15) 0px 20px 40px -10px,
                rgba(0, 0, 0, 0.2) 0px 10px 20px -10px,
                rgba(10, 37, 64, 0.15) 0px -1px 3px 0px inset;
            font-family: 'Segoe UI', sans-serif;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Image container with overlay */
        .blog-image-container {
            position: relative;
            overflow: hidden;
        }

        .blog-card img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Overlay that appears on hover */
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 165, 0, 0.5);
            /* orange with 50% transparency */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(2px);
        }

        /* Centered read more button */
        .read-more-center {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transform: translateY(20px) scale(0.9);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .read-more-center i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        /* Content section with animations */
        .blog-content {
            padding: 15px;
            position: relative;
            overflow: hidden;
        }

        .content-header {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 8px;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.6s ease forwards;
            animation-delay: 0.1s;
        }

        .blog-category {
            background: var(--gradient-orange);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transform: scale(0.9);
            animation: scaleIn 0.5s ease forwards;
            animation-delay: 0.2s;
        }

        .blog-date {
            font-size: 1rem;
            color: black;
        }

        .blog-title {
            font-size: 1.5rem;
            margin-top: 8px;
            margin-bottom: 0;
            color: black;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.6s ease forwards;
            animation-delay: 0.3s;
        }

        /* Hover effects */
        .swiper-slide:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }


        .swiper-slide:hover .blog-card img {
            transform: scale(1.1);
        }

        .swiper-slide:hover .image-overlay {
            opacity: 1;
        }

        .swiper-slide:hover .read-more-center {
            transform: translateY(0) scale(1);
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
        }

        .swiper-slide:hover .read-more-center:hover {
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary-orange);
            transform: translateY(0) scale(1.05);
        }

        .swiper-slide:hover .read-more-center:hover i {
            transform: translateX(5px);
        }

        /* Content animations on card hover */
        .swiper-slide:hover .blog-category {
            transform: scale(1) translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }

        .swiper-slide:hover .blog-title {
            transform: translateY(-2px);
        }

        /* Keyframe animations */
        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            to {
                transform: scale(1);
            }
        }

        /* Pagination styling */
        #blogPagination {
            margin-top: 20px;
            text-align: center;
        }

        #blogNext,
        #blogPrev {
            color: #000;
        }

        /* Mobile responsive */
        @media (max-width: 480px) {
            .blog-card {
                margin: 10px;
            }
        }
    </style>




    <style>
        .newsletter-section {
            margin: 0;
            padding: 40px 0;
            background: rgb(252 238 238 / 95%);
            display: flex;
            align-items: center;
        }

        .newsletter-card {
            padding: 2rem;
            text-align: center;
        }

        .newsletter-title {
            color: #333;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .newsletter-subtitle {
            color: #666;
            margin-bottom: 2rem;
        }

        .captcha-container {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .captcha-display img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .captcha-refresh {
            background: #6c757d;
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .captcha-refresh:hover {
            background: #5a6268;
            transform: scale(1.05);
        }

        .captcha-refresh:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-subscribe {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-subscribe:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .loading {
            display: none;
        }

        .loading.show {
            display: inline-block;
        }

        .privacy-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin: 1rem 0 0 0;
        }

        .form-control {
            border-radius: 8px;
            height: 50px;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .newsletter-card {
                padding: 1.5rem;
            }

            .d-flex.flex-md-row {
                gap: 1rem !important;
            }

            input[style*="width:400px"] {
                width: 100% !important;
            }
        }
    </style>
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


    <style>
        /* FORCE CLOSE BUTTON TO BE BLACK (Overrides Bootstrap completely) */
        .btn-close,
        .btn-close-white,
        .btn-close-black {
            filter: none !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") !important;
            opacity: 0.85 !important;
        }

        .btn-close:hover,
        .btn-close-black:hover {
            opacity: 1 !important;
        }

        /* CRITICAL FIX: Close button always clickable */
        #vacationModal .btn-close {
            z-index: 99999 !important;
            pointer-events: all !important;
        }

        /* Prevent sidebar from blocking close button */
        @media (min-width: 992px) {
            .col-lg-5 {
                position: relative;
                z-index: 1;
            }

            .col-lg-7 {
                position: relative;
                z-index: 2;
            }
        }

        /* Remove backdrop (your original style) */
        .modal-backdrop {
            height: 0;
            width: 0;
        }

        .modal-custom-header {
            color: black;
            padding: 1.4rem;
        }

        .sidebar-info {
            background: #F1C40F;
            color: black;
            border-radius: 10px;
            padding: 1.5rem;
        }

        @media (min-width: 992px) {
            .modal-xl {
                max-width: 800px !important;
            }
        }

        .form-group {
            width: 100%;
            position: relative;
            margin-bottom: 15px !important;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px 12px 40px;

        }



        .step-number {
            background: white;
            color: #1e3a8a;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .stat-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
    </style>

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
                                        <a href="https://wa.me/+91{!! $whatsapp_footer_link ?? '7838602000' !!}?text=Hi!%20I%20want%20to%20plan%20a%20vacation"
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