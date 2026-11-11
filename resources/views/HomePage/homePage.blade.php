@extends('layouts.webSite')
@section('title', 'Parivartan Welfare Association')
@section('content')
@include('include.slider')

    <div id="about" class="section lb">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="message-box">
                        <h2>Welcome to Parivartan Welfare Association</h2>
                        <p>With the idea of ​​nurturing the hidden talents in the rural areas, some people from 6 states
                            including Haryana province,
                            having an idea to promote from small children to trainers,
                            registered the organization "Parivartan Welfare Association" which will play a new role in
                            nation building. </p>
                        <p>ग्रामीण आँचल में छिपी प्रतिभाओं को निखारने के विचार को लेकर जिसमें छोटे बच्चों से लेकर प्रशिक्षको
                            तक को बढ़ावा देने के लिए एक विचार वाले हरियाणा
                            प्रान्त समेत 6 प्रदेशों के कुछ लोगों ने "परिवर्तन वेलफेयर एसोसिएशन" संस्था का पंजीकरण कराया
                            जिससे राष्ट्र निर्माण में नई भूमिका अदा की जा सके।</p>

                        <a href="{{ route('aboutUs') }}" class="sim-btn hvr-rectangle-out"><span>More About Us</span></a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="right-box-pro wow fadeIn">
                        <img src="uploads/about_04.jpg" alt="" class="img-fluid img-rounded">
                    </div><!-- end media -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->


    <div id="services" class="section lb">
        <div class="container-fluid">
            <div class="section-title text-center">
                <h3>Events</h3>
                <!-- <p>Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non aliquam risus.</p> -->
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Kabaddi.png">
                        </div>
                        <h2>Kabaddi</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Wrestling.png">
                        </div>
                        <h2>Wrestling</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Athletics.png">
                        </div>
                        <h2>Athletics</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Judo.png">
                        </div>
                        <h2>Judo</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Volleyball.png">
                        </div>
                        <h2>Volleyball</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Basketball.png">
                        </div>
                        <h2>Basketball</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Badminton.png">
                        </div>
                        <h2>Badminton</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Yoga.png">
                        </div>
                        <h2>Yoga</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Gymnastics.png">
                        </div>
                        <h2>Gymnastics</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/Karate.png">
                        </div>
                        <h2>Karate</h2>
                    </div>
                </div><!-- end col -->
                <div class="col-md-2">
                    <div class="services-inner-box">
                        <div class="">
                            <img src="images/football.png">
                        </div>
                        <h2>Football</h2>
                    </div>
                </div><!-- end col -->

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="contact" class="section db">
        <div class="container-fluid">
            <div class="section-title text-center">
                <h3>Contact Us</h3>
                <p>Parivartan Welfare Association</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form id="contactForm" name="sentMessage" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" id="name" type="text" placeholder="Your Name"
                                            required="required" data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" id="email" type="email" placeholder="Your Email"
                                            required="required"
                                            data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" id="phone" type="tel" placeholder="Your Phone"
                                            required="required"
                                            data-validation-required-message="Please enter your phone number.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Your Message" required="required"
                                            data-validation-required-message="Please enter a message."></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button id="sendMessageButton" class="sim-btn hvr-rectangle-out"
                                        data-text="Send Message" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
@endsection
