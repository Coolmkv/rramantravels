@extends('layouts.webSite')
@section('title', 'Terms & Conditions')
@section('content')
    <div class="information-page-slider   pt-100">
        <!-- <img src="./assets/img/travel-bg.jpg" alt="Home Stylers" class="img-fluid"> -->
        <div class="information-content">
            <ul class="m-auto list-unstyled custom-container">
                <!-- <li><a href="{{ url('/') }}">Home</a></li>
                                                                                                    <li><a href="javascript:void(0);">Terms and Conditions</a></li> -->
            </ul>
        </div>
    </div>
    <style>
        /* Global Styles */
        h1 {
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

        h1::after {
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

        a {
            color: #2980b9;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Container */
        .container {
            max-width: 1200px;

        }

        /* Headings */
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2em;
        }

        h2 {
            color: #34495e;
            margin-top: 25px;
            font-size: 1.4em;
        }

        /* Paragraphs and Lists */
        p {
            margin: 12px 0;
            font-size: 1em;
        }

        ul {
            margin: 10px 0 20px 25px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px 15px;
            }

            h1 {
                font-size: 1.8em;
            }

            h2 {
                font-size: 1.2em;
            }

            p,
            ul {
                font-size: 0.95em;
            }
        }

        @media (max-width: 480px) {
            .container {
                margin: 15px;
                padding: 15px 10px;
            }

            h1 {
                font-size: 1.6em;
            }

            h2 {
                font-size: 1.1em;
            }

            p,
            ul {
                font-size: 0.9em;
            }
        }
    </style>

    <div class="container" style="    margin: 40px auto;
                                            padding: 25px 20px;
                                ">
        <h1>Terms & Conditions</h1>

        <h2>1. Acceptance of Terms</h2>
        <p>By accessing or using <strong><a href="https://odishavoyages.com/"
                    style="color:orange">odishavoyages.com</a></strong>, you agree to follow
            these terms.</p>

        <h2>2. Use of Content</h2>
        <p>All content, images, and text on this website are for informational purposes only. Unauthorized copying or
            redistribution is prohibited.</p>

        <h2>3. Booking & Payment</h2>
        <p>Bookings via our website are subject to package terms and availability. Prices and offers may change without
            notice.</p>

        <h2>4. Liability</h2>
        <p>While we provide travel guidance and assistance, <strong><a href="https://odishavoyages.com/"
                    style="color:orange">odishavoyages.com</a></strong> is not responsible
            for personal accidents, delays, or unforeseen events during travel. Travelers are responsible for their own
            safety and compliance with local laws.</p>

        <h2>5. External Links</h2>
        <p>Our website may include links to third-party sites. We are not liable for the content or privacy practices of
            these external websites.</p>

        <h2>6. Modifications</h2>
        <p>We reserve the right to update these terms and policies at any time. Continued use of the website signifies
            acceptance of updated terms.</p>

        <h2>7. Governing Law</h2>
        <p>These policies are governed by the laws of India.</p>

        <h2>Contact Us</h2>
        <p>For questions regarding privacy or website policies, contact us at <a href="mailto:odishavoyages@gmail.com"
                style="color:orange;">odishavoyages@gmail.com</a>
            or call
            <a href="tel:+919899088497" style="color:orange;">9899088497</a>


        </p>
    </div>


@endsection