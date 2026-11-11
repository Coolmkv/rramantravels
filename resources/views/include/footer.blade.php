<?php
use App\Models\DestinationsModel;

$webElements = getWebsiteElements();

$destinations = DestinationsModel::where('status', '1')->get();

?>
<footer class="footer">
    <hr />
    <div class="container-fluid">
        <div class="row footer-top">
            <div class="col-lg-3 col-md-6 col-sm-12 footer-section logo-section">
                @php
    $footerLogo = $webElements['Logo'] ?? null;
    $footerLogoUrl = $footerLogo
        ? (
            \Illuminate\Support\Str::startsWith($footerLogo, ['http://', 'https://'])
                ? $footerLogo
                : asset(ltrim($footerLogo, '/'))
        )
        : asset('assets/images/logo1.png');
@endphp

@if(!empty($footerLogo))
                    <img src="{{ $footerLogoUrl }}"
                        style="height:150px;width:150px;" alt="Logo">
                @else
                    <img src="{{ $footerLogoUrl }}" style="height:150px;width:150px;" alt="Logo">
                @endif
                <p>Where devotion meets ocean waves and hearts.</p>
                <label for="enquiry" class="btn-enquire">ENQUIRE NOW</label>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-12 footer-section">
                <h4>Quick Link</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                    <li><a href="{{ route('galleryPages') }}">Gallery</a></li>
                    <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
                    <li><a href="{{ route('blogpage') }}">Blogs</a></li>
                    <li><a href="{{ route('tourpage') }}">Packages</a></li>
                    <li><a href="{{ route('activitiespage') }}">Activities</a></li>
                    <li><a href="{{ route('servicePages') }}">Services</a></li>

                </ul>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 footer-section">
                <h4>Major Attractions</h4>
                <ul>
                    {{-- 👈 Loop through the fetched destinations --}}
                    @forelse($destinations as $destination)
                        <li>
                            <a
                                href="{{ route('destinationDetailpage', ['destination_slug' => $destination->destination_slug]) }}">
                                {{ $destination->destination_name }}
                            </a>
                        </li>
                    @empty
                        <li>No attractions available.</li>
                    @endforelse
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 footer-section">
                <h4>Contact Information</h4>

                {{-- Dynamic Email with static fallback --}}
                @if(isset($webElements['Email']))
                    <p>
                        <i class="fas fa-envelope"></i>
                        <strong>E-mail:</strong>
                        <a href="mailto:{!! $webElements['Email'] !!}">{!! $webElements['Email'] !!}</a>
                    </p>
                @else
                    <p>
                        <i class="fas fa-envelope"></i>
                        <strong>E-mail:</strong>
                        <a href="mailto:info@odishavoyages.co.in">info@odishavoyages.co.in</a>
                    </p>
                @endif

                {{-- Dynamic Phone Number with static fallback --}}
                            
                @if(isset($webElements['Phone_number1']))

                    <p>
                        <i class="fas fa-phone"></i>
                        <strong>Contact No:</strong>
                        <a href="tel:{!! $webElements['Phone_number1'] !!}">{!! $webElements['Phone_number1'] !!}</a>
                    </p>
                @else
                    <p>
                        <i class="fas fa-phone"></i>
                        <strong>Contact No:</strong>
                        <a href="tel:9899088497">9899088497</a>
                    </p>
                @endif

                {{-- Dynamic Address with static fallback --}}
                @if(isset($webElements['Address']))
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Address:</strong> {!! $webElements['Address'] !!}
                    </p>
                @else
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong>Address:</strong> Block K, Birbal Road, Jangpura Ext., New Delhi - 110014
                    </p>
                @endif

                <div class="social-icons">
                    @if(isset($webElements['facebook_link']))
                        <a href="{{ url(strip_tags($webElements['facebook_link'])) }}" target="_blank"
                            aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @else
                        <a href="YOUR_STATIC_FACEBOOK_URL" target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif

                    @if(isset($webElements['insta_link']))
                        <a href="{{ url(strip_tags($webElements['insta_link'])) }}" target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @else
                        <a href="YOUR_STATIC_INSTAGRAM_URL" target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif

                    @if(isset($webElements['youtube_link']))
                        <a href="{{ url(strip_tags($webElements['youtube_link'])) }}" target="_blank" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @else
                        <a href="YOUR_STATIC_YOUTUBE_URL" target="_blank" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif

                    @if(isset($webElements['pinterest_link']))
                        <a href="{{ url(strip_tags($webElements['pinterest_link'])) }}" target="_blank"
                            aria-label="Pinterest">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    @else
                        <a href="YOUR_STATIC_PINTEREST_URL" target="_blank" aria-label="Pinterest">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    @endif

                    {{-- @if(isset($webElements['linkedin_link']))
                    <a href="{!! $webElements['linkedin_link'] !!}" target="_blank" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @else
                    <a href="YOUR_STATIC_LINKEDIN_URL" target="_blank" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif --}}

                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-bottom-content d-flex justify-content-between align-items-center flex-wrap">
                        <p class="mb-0">© 2025 All Rights Reserved by odisha voyages & Developed by <a href="#">Vyapar
                                kranti</a></p>
                        <div class="footer-links">
                            <a href="{{ route('termsConditions') }}">Terms & Conditions</a>
                            <span class="mx-2">|</span>
                            <a href="{{ route('privacyPolicy') }}">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .social-icons a {
        display: inline-block;
        margin-right: 20px;
        /* Increased space between icons */
        color: #fff;
        /* Example color */
        font-size: 24px;
        /* Increased icon size */
        transition: transform 0.3s ease;
        /* Optional: for a subtle zoom effect on hover */
    }

    .social-icons a:hover {
        color: #your-hover-color;
        /* Add a hover effect */
        transform: scale(1.1);
        /* Optional: for a subtle zoom effect on hover */
    }

    a:hover {
        color: white;
    }

    .footer {
        background: #B71C1C;
        color: white;
        font-family: Arial, sans-serif;
    }

    .footer-top {
        padding: 30px 15px;
    }

    @media only screen and (min-width: 768px) {
        .footer-top {
            padding: 30px 100px;
        }
    }

    .footer-section {
        margin-bottom: 20px;
    }

    .footer-section h4 {
        font-weight: bold;
        margin-bottom: 10px;
        color: white;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-section ul li {
        margin: 5px 0;
    }

    .footer-section ul li a {
        text-decoration: none;
        color: white;
    }

    .btn-enquire {
        display: inline-block;
        padding: 8px 15px;
        background: #F1C40F;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .footer-bottom {
        background: #7d2424;
        padding: 10px 20px;
        text-align: center;
        font-size: 14px;

    }

    .footer-bottom-content p {
        margin: 0;
    }

    .footer-links {
        display: flex;
        align-items: center;
    }

    .footer-links a {
        color: white;
        text-decoration: none;
        font-size: 14px;
    }

    .footer-links a:hover {
        text-decoration: underline;
    }

    .footer-links span {
        color: white;
    }

    .footer-bottom a {
        color: white;
        font-weight: bold;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 768px) {
        .footer-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .footer-bottom-content {
            flex-direction: column !important;
            gap: 10px;
            text-align: center !important;
        }

        .footer-links {
            justify-content: center;
        }
    }
</style>
<!-- footer area end -->
<input id="enquiry" hidden="" type="checkbox">
<section class="enquiry-form">
    <label for="enquiry" class="enquiry-button">Enquire now</label>
    <div class="enquiry-container">
        <div class="contact-box_right_box">
            <div class="contact-box_form_box">

                <div id="success"></div>
                <form id="enquiryForm">
                    @csrf
                    <div class="control-group mt-25">
                        <input type="text" class="form-control bg-transparent p-4" id="name" name="name"
                            placeholder="Your Name" required title="Please enter your name">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number"
                            required>
                        <p class="help-block text-danger"></p>
                    </div>
                    <!-- <div class="control-group">
                        <input type="text" class="form-control bg-transparent p-4" id="subject"  name="subject" placeholder="Subject" required="true" data-validation-required-message="Please enter a subject">
                        <p class="help-block text-danger"></p>
                    </div> -->
                    <div class="control-group">
                        <textarea class="form-control bg-transparent py-3 px-4" rows="2" id="message" name="message"
                            placeholder="Message" required="true"
                            data-validation-required-message="Please enter your message"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <!-- <x-input-with-label-element id="captcha" type="text" label="Captcha" name="captcha" required placeholder="Captcha"></x-input-with-label-element> -->
                    <!-- <div class="col-md-12 col-sm-12 mb-3">
                        <div class="row">
                            <div class="col-md-6 pt-4">
                                <img  class="img-thumbnail h-100" src="{{ captcha_src() }}" id="captcha_img_id2">
                            </div>
                            <div class="col-md-6 pt-4 view-button">
                                <button type="button" class="btn default-btn btn-block font-weight-bold" onclick="refreshCapthca('captcha_img_id2','captcha')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16"> <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" /><path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" /></svg> Refresh </button>
                            </div>
                        </div>
                    </div> -->
                    <div class="" style="display:flex">
                        <input class="form-check-input  " style="padding:8px;height:0px" type="checkbox" value=""
                            id="tnc" required>
                        <label class="form-check-label" for="tnc" style="font-size:15px"> I have read and
                            agree to the <a href="{{ url('terms-conditions') }}" style="color:blue">Terms &
                                Conditions.</a>
                        </label>
                    </div>
                    <div>
                        <button class="btn btn-primary font-weight-bold py-3 px-5" id="submitButton" type="submit">Send
                            Message</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<style>
    a {
        color: white;
    }

    section.enquiry-form {
        position: fixed;
        top: 50%;
        right: -0%;
        z-index: 99;
        transition: var(--transition);
        margin-left: 40px;
        transform: translateY(-50%);
        margin-right: -400px;
    }

    .enquiry-button {
        transform: rotate(-90deg);
        top: 50%;
        left: calc(0% - 40px - 40px);
        cursor: pointer;
        margin: 0 0;
        color: #ffffff;
        height: 40px;
        user-select: none;
        -moz-user-select: none;
        line-height: 40px;
        padding: 0 15px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        /* background-color: rgb(var(--blue-color)); */
        background: var(--primary-color);
        -webkit-animation: liner_bg 5s ease infinite;
        animation: liner_bg 5s ease-in-out infinite;
        background-size: 300% 300%;
        position: absolute;
        border: 1px solid rgb(var(--black-color));
    }

    .contact-box_form_box {
        background-color: #fff;
        padding: 15px;
        border-radius: 10px;
        max-width: 400px;
        min-width: 400px;
        margin: 1rem auto;
        width: 100%;
    }

    .btn-primary {
        color: #fff;
        border-color: var(--primary-color) !important;
        background-color: var(--primary-color) !important;
        text-align: center;

    }

    #enquiry:checked+.enquiry-form {
        margin-right: 0px;
    }

    .enquiry-container {
        box-shadow: 0px 0px 15px -5px rgba(0 0 0 / 0.5);
    }

    @-webkit-keyframes liner_bg {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes liner_bg {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    input,
    select,
    textarea,
    .nice-select,
    .form-control {
        width: 100%;
        height: auto;
        font-weight: 400;
        border-radius: 0;
        font-size: 16px;
        padding: 15px 30px;
        /* background-color: grey; */
        border: 1px solid #757070;
        font-family: var(--heading-font);
        -webkit-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }
</style>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>