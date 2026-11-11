<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}" defer></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('assets/js/appear.min.js') }}" defer></script>
<script src="{{ asset('assets/js/slick.min.js') }}" defer></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}" defer></script>
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}" defer></script>
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}" defer></script>
<script src="{{ asset('assets/js/skill.bars.jquery.min.js') }}" defer></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>
<script src="{{ asset('assets/js/aos.js') }}" defer></script>
<script src="{{ asset('assets/js/script.js') }}" defer></script>
<script src="{{ asset('assets/js/swiper-bundle.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<script src="{{ asset('assets/js/jquery.fancybox.js') }}" defer></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>

<a class="footer-whatsapp" aria-label="Whatsapp Button"
    href="https://wa.me/+91{!! $whatsapp_footer_link ?? '7838602000' !!}?text=Let%27s+start+build+a+project"><img
        src="{{ asset('./assets/images/whatsapp.png') }}" alt="Whatsapp" class="img-fluid" height=""
        width="150"></a>
<a class="footer-whatsapp footer-call" aria-label="Phone Call Button"
    href="tel:+91{{ isset($phone_footer_link) ? str_replace(' ', '', $phone_footer_link) : '7838602000' }}"><img
        src="{{ asset('./assets/images/phone-call.png') }}" alt="Phone Call" class="img-fluid" height=""
        width="150"></a>

<script>
    function errorMessage(error_message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error_message
        });
    }

    function successMessage(success_message, reload = false) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: success_message
        }).then(function() {
            if (reload) {
                window.location.reload();
            }
        });
    }
</script>


<!-- <script>
    var swiper = new Swiper(".main-slider", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        fadeEffect: {
            crossFade: true, // Ensures a smooth transition between images
        },
    });
</script> -->
<script>
    const sliderswiper = new Swiper(".main-slider", {
        slidesPerView: 1,
        autoplay: {
            delay: 5000,
        },
        loop: true,

        effect: 'fade',
        fadeEffect: {
            crossFade: true,
        },

        speed: 2000,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    const testimonialswiper = new Swiper('.testimonials-active', {
            loop: true, // Enable infinite loop
            autoplay: {
                delay: 5000, // Auto-slide every 5 seconds
            },
            // pagination: {
            //     el: '.swiper-pagination',
            //     clickable: true, // Enable pagination clicks
            // },
            // navigation: {
            //     nextEl: '.swiper-button-next',
            //     prevEl: '.swiper-button-prev',
            // },
            slidesPerView: 1, // Show one slide at a time
        });
</script>
<script>
    // Attach submit event handler to the form
    $("#enquiryForm").on("submit", function(e) {
        e.preventDefault(); // Prevent default form submission

        // Create FormData object
        var form = new FormData(this);

        // Disable the submit button to prevent multiple submissions
        $("#submitButton").attr("disabled", true);

        // Send AJAX POST request
        $.ajax({
            type: 'post',
            url: '{{ route('saveEnquiryFormData') }}', // Backend route for saving contact details
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status) {
                    // Display success message
                    successMessage(response.message, true);

                    // Reset the form after successful submission
                    $("#enquiryForm")[0].reset();

                    // Re-enable the submit button
                    $("#submitButton").attr("disabled", false);
                } else {
                    // Display error message
                    errorMessage(response.message ?? "Something went wrong.");
                    $("#submitButton").attr("disabled", false);
                }
            },
            failure: function(response) {
                // Handle failure response
                errorMessage(response.message ?? "Something went wrong.");
                $("#submitButton").attr("disabled", false);
            },
            error: function(response) {
                // Handle error response
                errorMessage(response.message ?? "Something went wrong.");
                $("#submitButton").attr("disabled", false);
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
<script>
  var swiper = new Swiper('.packages', {
       loop: true,
       spaceBetween: 20, 
       autoplay: {
         delay: 2500,
         disableOnInteraction: false,
       },
       breakpoints: {
           500:{slidePerView:1},
           768: { slidesPerView: 2 }, 
           1024: { slidesPerView: 4 }
       }
   });
</script>
<script type="text/javascript"></script>
