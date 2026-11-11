@extends('layouts.webSite')
@section('title', 'Privacy Policy')
@section('content')
    <div class="information-page-slider">
        <div class="information-content pt-80">
            <!-- <ul class="m-auto list-unstyled custom-container"> -->
            <!-- <li><a href="{{ url('/') }}">Home</a></li> -->
            <!-- <li><a href="javascript:void(0);">Privacy Policy</a></li> -->
            <!-- </ul> -->
        </div>
    </div>
    <style>
        /* Global Styles */
        h1 {
            font-size: 2rem;
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

    <div class="container" style="       margin: 40px auto;
                                                        padding: 25px 20px;
                                                 ">
        <h1 class="text-center">Privacy Policy</h1>

        <h2>1. Introduction</h2>
        <p>At <strong><a style="color:orange" href="https://odishavoyages.com/">odishavoyages.com</a></strong>, your privacy
            is our priority. This policy explains
            how we collect, use,
            and protect the information you provide while using our website.</p>

        <h2>2. Information Collection</h2>
        <p>We may collect personal information such as your name, email, phone number, and travel preferences when you:</p>
        <ul>
            <li>Book travel packages</li>
            <li>Subscribe to newsletters</li>
            <li>Contact us for inquiries</li>
        </ul>
        <p>We also collect non-personal data like IP addresses, browser type, and usage patterns to improve website
            performance.</p>

        <h2>3. Use of Information</h2>
        <p>Collected information may be used to:</p>
        <ul>
            <li>Process bookings and provide travel services</li>
            <li>Send promotional updates and newsletters (you can unsubscribe anytime)</li>
            <li>Enhance website functionality and user experience</li>
        </ul>

        <h2>4. Data Protection</h2>
        <p>We employ strict security measures to safeguard your data from unauthorized access, alteration, or disclosure.
        </p>

        <h2>5. Third-Party Services</h2>
        <p>Trusted third-party services (like payment gateways or analytics tools) may access limited information to provide
            services. We do not sell your personal data.</p>

        <h2>6. Cookies</h2>
        <p>Our website uses cookies to improve user experience and track website performance. You can manage cookies via
            browser settings.</p>

        <h2>7. Your Rights</h2>
        <p>You can access, modify, or request deletion of your personal information. Contact us at <a
                href="mailto:odishavoyages@gmail.com" style="color:orange"> odishavoyages@gmail.com</a> for assistance.</p>

        <h2>8. Updates</h2>
        <p>This privacy policy may be updated periodically. Please check this page regularly for changes.</p>
    </div>


@endsection