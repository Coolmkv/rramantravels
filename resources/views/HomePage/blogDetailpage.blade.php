@extends('layouts.webSite')
@section('title', $blogs->meta_title)
@section('meta_description', $blogs->meta_description)
@section('meta_keywords', $blogs->meta_keyword)
@section('content')
       

        
        <!-- Blog Detaisl Area start -->
        <section class="blog-detaisl-page py-100 rel z-1">
                <div class="blog-banner" style="margin-bottom:50px; ">
                    <img src="./assets/images/bannerblog.jpg" alt="" style="max-height:200px;width:100%; object-fit:cover;" >
                </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-details-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <a class="category">{{ $blogs->blog_category }}</a>
                            <!-- <ul class="blog-meta mb-30">
                                <li><img src="./assets/images/admin.jpg" alt="Admin"> <a href="#">Reed A. Johnson</a></li>
                                <li><i class="far fa-calendar-alt"></i> <a>25 Feb 2024</a></li>
                                <li><i class="far fa-comments"></i> <a>Comments (5)</a></li>
                            </ul> -->
                            {{-- <p>Tour and travel agency is a business that assists travelers with the planning, booking, and execution of their travel experiences. This can include everything from transportation and accommodation to guided tours, activities, to more. It sounds like you're looking for a comprehensive guide or overview related to a tour and travel agency.</p> --}}
                            <div class="image mt-40 mb-30" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <img src="{{ asset($blogs->image) }}" alt="Blog Details">
                            </div>
                            <h5>{{ $blogs->title }}</h5>
                            {{-- <p>Agency plays a pivotal role in crafting memorable experiences for travelers by offering wide range services tailored to individual preferences. Whether it's a family vacation, an adventure trip, or luxury getaway well-established travel agency can handle everything from flight bookings and accommodation to guided tours .</p>
                            <ul class="list-style-two mt-30 mb-45" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <li>Assisting customers in booking domestic and international flights.</li>
                                <li>Organizing adventure activities such as trekking, diving, safaris, or extreme sports.</li>
                                <li>Tailoring travel plans to meet the specific needs and preferences of the customer.</li>
                                <li>Providing professional guides for city tours, cultural experiences, adventure activities, etc.</li>
                                <li>Arranging local transportation such as car rentals, airport transfers, or bus tours.</li>
                                <li>Helping customers navigate the visa application process for international travel.</li>
                            </ul> --}}
                            <p class="text-justify">{!! $blogs->content !!}</p>
                            {{-- <div class="row mb-10">
                                <div class="col-sm-6">
                                    <div class="image mb-30" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                        <img src="./assets/images/blog-middle1.jpg" alt="Blog">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="image mb-30" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50" data-aos-delay="50">
                                        <img src="./assets/images/blog-middle2.jpg" alt="Blog">
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <h5>How to Start a Tour and Travel Agency</h5>
                            <p>Agency plays a pivotal role in crafting memorable experiences for travelers by offering wide range services tailored to individual preferences. Whether it's a family vacation, an adventure trip, or luxury getaway well-established travel agency can handle everything from flight bookings and accommodation to guided tours .</p> --}}
                            {{-- <blockquote class="mt-30 mb-35" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <i class="flaticon-quote"></i>
                                <div class="text">"In the world of tours and travel, every journey is an invitation to explore the unknown, connect with cultures, and create memories that last lifetime It's not just about the destination,extraordinary adventures."
                                </div>
                                <div class="blockquote-footer">
                                    Kevin F. Glasscock
                                </div>
                            </blockquote> --}}
                            {{-- <ul class="list-style-two mb-45" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <li>Understand the demand in your area, competition, and potential customers.</li>
                                <li>Register your business, obtain necessary licenses, and ensure compliance with local regulations.</li>
                                <li>Build relationships with hotels, airlines, transport companies, and other service providers.</li>
                            </ul> --}}
                        </div>
                            
                        {{-- <hr class="mb-45"> --}}

                        {{-- <div class="tag-share mb-50">
                            <div class="item" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                                <h6>Tags </h6>
                                <div class="tag-coulds">
                                    <a href="{{ route('blogpage') }}">Travel</a>
                                    <!-- <a href="{{ route('blogpage') }}">Hotel</a> -->
                                    <a href="{{ route('blogpage') }}">Tour</a>
                                </div>
                            </div>
                            <div class="item" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                                <h6>Share </h6>
                                <div class="social-style-one">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div> --}}

                        <!-- <div class="admin-comment bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="comment-body">
                                <div class="author-thumb">
                                    <img src="./assets/images/admin-comment.jpg" alt="Author">
                                </div>
                                <div class="content">
                                    <h4>Richard M. Fudge</h4>
                                    <p>The world is a book, and those who do not travel read only one page. Every journey we undertake is a chapter filled with lessons, experiences, and stories.</p>
                                    <div class="social-icons">
                                        <a href="{{ route(name: 'contactUs') }}"><i class="fab fa-facebook-f"></i></a>
                                        <a href="{{ route(name: 'contactUs') }}"><i class="fab fa-twitter"></i></a>
                                        <a href="{{ route(name: 'contactUs') }}"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="{{ route(name: 'contactUs') }}"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                           
                        {{-- <div class="next-prev-blog pt-70 pb-15">
                            <div class="item" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <img src="./assets/images/news1.jpg" alt="News">
                                </div>
                                <div class="content">
                                    <h6><a href="{{ route('blogDetailpage') }}">Unique Destinations an tolded Stories ways</a></h6>
                                    <span class="date"><i class="far fa-calendar-alt"></i> 25 Feb 2024</span>
                                </div>
                            </div>
                            <div class="item" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <img src="./assets/images/news2.jpg" alt="News">
                                </div>
                                <div class="content">
                                    <h6><a href="{{ route('blogDetailpage') }}">Immersive Experiences from Around Globe</a></h6>
                                    <span class="date"><i class="far fa-calendar-alt"></i> 25 Feb 2024</span>
                                </div>
                            </div>
                        </div> --}}
                        
                        {{-- <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-25" name="review-form" action="#" method="post" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h5>Leave A Comments</h5>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            <div class="row gap-20 mt-30">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="full-name" name="full-name" class="form-control" placeholder="Name" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="email-address" name="email" class="form-control" placeholder="Email" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                       <ul class="radio-filter mb-25">
                                            <li>
                                                <input class="form-check-input" type="radio" name="terms-condition" id="terms-condition">
                                                <label for="terms-condition">Save my name, email, and website in this browser for the next time I comment.</label>
                                            </li>
                                        </ul>
                                        <button type="submit" class="theme-btn style-two">
                                            <span data-hover="Send Comments">Send Comments</span>
                                            <i class="fal fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form> --}}
                            
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                        <div class="blog-sidebar">
                            
                            {{-- <div class="widget widget-search" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <form action="#" class="default-search-form">
                                    <input type="text" placeholder="Search" required="">
                                    <button type="submit" class="searchbutton far fa-search"></button>
                                </form>
                            </div> --}}
                            
                            <!-- <div class="widget widget-category" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h5 class="widget-title">Category</h5>
                                <ul class="list-style-three">
                                    <li><a href="blog.php">Adventure</a></li>
                                    <li><a href="blog.php">Hiking & Trekking</a></li>
                                    <li><a href="blog.php">Cycling Tours</a></li>
                                    <li><a href="blog.php">Family Tours</a></li>
                                    <li><a href="blog.php">Mountain Hiking</a></li>
                                    <li><a href="blog.php">Rafting Excursion</a></li>
                                    <li><a href="blog.php">Coastal Paragliding</a></li>
                                </ul>
                            </div> -->
                            
                            <div class="widget widget-news" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h5 class="widget-title">Recent Blogs</h5>
                                <ul>
                                    @foreach($otherBlogs as $otherBlog)
                                    <li>
                                        <div class="image">
                                            <img src="{{ asset($otherBlog->image) }}" alt="{{ $otherBlog->title }}">
                                        </div>
                                        <div class="content">
                                            <h6><a href="{{ route('blogDetailpage', ['slug' => $otherBlog->slug]) }}">{{ $otherBlog->title }}</a></h6>
                                            <span class="date"><i class="far fa-calendar-alt"></i>{{ $otherBlog->blog_date }}</span>
                                        </div>
                                    </li>
                                    @endforeach
                                    {{-- <li>
                                        <div class="image">
                                            <img src="./assets/images/news1.jpg" alt="News">
                                        </div>
                                        <div class="content">
                                            <h6><a href="{{ route('blogDetailpage') }}">Unique Destinations an tolded Stories ways</a></h6>
                                            <span class="date"><i class="far fa-calendar-alt"></i> 25 Feb 2024</span>
                                        </div>
                                    </li> --}}
                                    {{-- <li>
                                        <div class="image">
                                            <img src="./assets/images/news2.jpg" alt="News">
                                        </div>
                                        <div class="content">
                                            <h6><a href="{{ route('blogDetailpage') }}">Immersive Experiences from Around Globe</a></h6>
                                            <span class="date"><i class="far fa-calendar-alt"></i> 25 Feb 2024</span>
                                        </div>
                                    </li> --}}
                                    {{-- <li>
                                        <div class="image">
                                            <img src="./assets/images/news3.jpg" alt="News">
                                        </div>
                                        <div class="content">
                                            <h6><a href="{{ route('blogDetailpage') }}">Journey to Inspire Your Next Adventure</a></h6>
                                            <span class="date"><i class="far fa-calendar-alt"></i> 25 Feb 2024</span>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                            
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Detaisl Area end -->
        
@endsection
        

    