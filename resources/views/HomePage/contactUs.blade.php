@extends('layouts.webSite')
@section('title', 'Contact Us')
@section('content')


    <!-- Contact Info Area start -->

    <!-- Contact Info Area end -->

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
    </style>
    <!-- Contact Form Area start -->
    <section class="contact-form-area py-70  rel z-1" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"
        style="margin-top:100px;">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="comment-form bgc-lighter z-1 rel mb-30 rmb-55">
                        <form id="contactForm" name="contactForm" data-aos="fade-left" data-aos-duration="1500"
                            data-aos-offset="50">
                            @csrf
                            <div class="section-title">
                                <h3>Get In Touch</h3>
                            </div>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            <div class="row mt-35">

                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Full Name" required>
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone-alt"></i>
                                        </span>
                                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                                            placeholder="Phone" required>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <input type="text" id="address" name="address" class="form-control"
                                            placeholder="Enter your address" required>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="fas fa-comment-alt"></i>
                                        </span>
                                        <textarea name="message" id="message" class="form-control" placeholder="Message"
                                            rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 d-flex align-items-start" style="flex-wrap: nowrap;">
                                    <input class="form-check-input me-2 mt-1" style="padding:10px" type="checkbox" id="tnc"
                                        required>

                                    <label class="form-check-label" for="tnc" style="font-size:14px;">
                                        I agree to the
                                        <a href="{{ url('privacy-policy') }}" style="color:orange;">Privacy Policy</a>
                                        and consent to receive marketing and transactional updates via RCS, SMS, WhatsApp,
                                        and email.
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <button id="submitButtons" type="submit" class="theme-btn style-two">
                                        <span data-hover="Send Comments">Submit</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-images-part" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset($contactus_image1 ?? './assets/images/bhu3.jpg') }}" alt="Contact"
                                    class="contact-us_image1">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset($contactus_image2 ?? './assets/images/korank1.jpg') }}" alt="Contact"
                                    class="contact-us_image2">
                            </div>
                            <div class="col-6">
                                <img src="{{ asset($contactus_image3 ?? './assets/images/chilikalake.jpg') }}" alt="Contact"
                                    class="contact-us_image3">
                            </div>
                        </div>
                        <div class="circle-logo">
                            <img src="{{ asset($Logo ?? './assets/images/logo1.png') }}" alt="Logo">
                            <!-- <span class="title h2">Ravelo</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form Area end -->


    <!-- Contact Map Start -->
    <div class="contact-map container">
        <iframe
            src="{!! $Map_link ?? 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3742.1397193443945!2d85
                                                                                                    .81330919!3d20.2944831!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19090aba25ac3b%3A0x60fce4144916546f!2sCookies%20IRC%20VILLAGE!5e0!3m2!1sen!2sin!4v1756291110040!5m2!1sen!2sin' !!}"
            width="100%" style="border:0; display:block; margin:auto;height:300px;margin-bottom:20px" allowfullscreen=""
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Contact Map End -->
    <style>
        img.contact-us_image1 {
            max-height: 200px;
            min-height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        img.contact-us_image2,
        img.contact-us_image3 {
            max-height: 300px;
            min-height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
@endsection
@section('pageScript')
    <script type="text/javascript"></script>
@endsection
@section('script')
    <script>
        // Attach submit event handler to the form
        $("#contactForm").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission

            // Create FormData object
            var form = new FormData(this);

            // Disable the submit button to prevent multiple submissions
            $("#submitButtons").attr("disabled", true);

            // Send AJAX POST request
            $.ajax({
                type: 'post',
                url: '{{ route('saveContactUsDetails') }}', // Backend route for saving contact details
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status) {
                        // Display success message
                        successMessage(response.message, true);

                        // Reset the form after successful submission
                        $("#contactForm")[0].reset();

                        // Re-enable the submit button
                        $("#submitButtons").attr("disabled", false);
                    } else {
                        // Display error message
                        errorMessage(response.message ?? "Something went wrong.");
                        $("#submitButtons").attr("disabled", false);
                    }
                },
                failure: function (response) {
                    // Handle failure response
                    errorMessage(response.message ?? "Something went wrong.");
                    $("#submitButtons").attr("disabled", false);
                },
                error: function (response) {
                    // Handle error response
                    errorMessage(response.message ?? "Something went wrong.");
                    $("#submitButtons").attr("disabled", false);
                }
            });
        });

        // Function to refresh the CAPTCHA (if applicable)
        // function refreshCapthca(captchaImgId, captchaInputId) {
        //     // Replace the CAPTCHA image source to reload it
        //     $("#" + captchaImgId).attr("src", "{{ captcha_src() }}" + "?" + Math.random());

        //     // Clear the CAPTCHA input field
        //     $("#" + captchaInputId).val('');
        // }
    </script>
@endsection