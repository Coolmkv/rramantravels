<header class="main-header header-one white-menu menu-absolute">
    <div class="header-upper">
        <div class="container-fluid clearfix">
            <div class="header-inner rel d-flex align-items-center">
                <div class="logo-outer">
                    <div class="logo"><a href="{{ url('/') }}"><img src="{{asset($Logo ?? 'assets/images/logo1.png')}}"
                                alt="Logo" title="Logo"></a></div>
                </div>

                <div class="nav-outer mx-lg-auto clearfix">
                    <nav class="main-menu navbar-expand-lg">
                        <div class="navbar-header">
                            <div class="mobile-logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{asset($Logo ?? 'assets/images/logo1.png')}}" alt="Logo" title="Logo">
                                </a>
                            </div>
                            <button type="button" class="navbar-toggle" data-bs-toggle="collapse"
                                data-bs-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="mobileMenu">
                            <ul class="navigation clearfix" style="padding-left:0px;margin-bottom:0px;">
                                <button id="closeMenu" type="button" class="btn-close d-lg-none ms-auto"
                                    aria-label="Close" style="position: absolute; right: 20px; top:0px;"></button>
                                <li><a href="{{ route('tourpage') }}">Packages</a></li>
                                <li><a href="{{ route('destinationpage') }}">Attractions</a></li>
                                <li><a href="{{ route('activitiespage') }}">Activities</a></li>
                                <li><a href="{{ route('servicePages') }}">Services</a></li>
                                <li><a href="{{ route('galleryPages') }}">Gallery</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <style>
                    * Hide the Google translate top bar completely */ .goog-te-banner-frame.skiptranslate {
                        display: none !important;
                    }

                    .goog-te-gadget-icon {
                        display: none !important;
                    }

                    /* Prevent body shifting down when banner appears */
                    body {
                        top: 0px !important;
                    }

                    /* Styles for your custom language buttons */
                    .language-switcher-custom {
                        display: flex;
                        gap: 10px;
                        align-items: center;
                        border: 1px solid #ddd;
                        padding: 5px;
                        border-radius: 5px;
                    }

                    .language-switcher-custom .lang-button {
                        background: none;
                        border: none;
                        color: #333;
                        cursor: pointer;
                        font-weight: bold;
                        transition: color 0.3s ease;
                        display: flex;
                        align-items: center;
                        gap: 5px;
                        /* Adds space between the flag and the text */
                    }

                    .language-switcher-custom .lang-button img {
                        height: 14px;
                        /* Adjust flag size as needed */
                        width: auto;
                    }

                    .language-switcher-custom .lang-button:hover {
                        color: #007bff;
                        /* Example hover color */
                    }
                </style>

                <div class="menu-btns py-10">
                    <a href="{{ url('contact-us') }}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Book Now">Book Now</span>
                        <i class="fa fa-arrow-right"></i>
                    </a>

                    <div class="language-switcher-custom notranslate">
                        <button onclick="translatePage('en')" class="lang-button">
                            <img src="https://flagcdn.com/w20/gb.png" alt="English Flag">
                            <span>EN</span>
                        </button>
                        <button onclick="translatePage('hi')" class="lang-button">
                            <img src="https://flagcdn.com/w20/in.png" alt="Hindi Flag">
                            <span>HI</span>
                        </button>
                        <button onclick="translatePage('fr')" class="lang-button">
                            <img src="https://flagcdn.com/w20/fr.png" alt="French Flag">
                            <span>FR</span>
                        </button>
                    </div>

                    <div id="google_translate_element" style="display: none;"></div>
                </div>

                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement(
                            {
                                pageLanguage: 'en',
                                includedLanguages: 'en,hi,fr',
                                layout: google.translate.TranslateElement.InlineLayout.NO_UNION
                            },
                            'google_translate_element'
                        );

                        // The logic to link the custom buttons to the hidden dropdown
                        window.translatePage = function (langCode) {
                            var select = document.querySelector('.goog-te-combo');
                            if (select) {
                                select.value = langCode;
                                select.dispatchEvent(new Event('change'));
                            }
                        };
                    }
                </script>

                <script>
                    function hideGoogleTranslateBar() {
                        var frame = document.querySelector(".goog-te-banner-frame");
                        if (frame) {
                            frame.style.display = "none";
                            document.body.style.top = "0px"; // Reset body offset
                        }
                    }

                    // Run when page loads and again after translations
                    document.addEventListener("DOMContentLoaded", function () {
                        setInterval(hideGoogleTranslateBar, 500);
                    });
                </script>


                <script type="text/javascript"
                    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
        </div>
    </div>
</header>