@extends('layouts.webSite')
@section('title', 'Our Packages')
@section('content')
    <div class="filtered-packages">

        {{-- <div class="row">
            @if ($packages && count($packages) > 0)
                @foreach ($packages as $item)
                    @php
                        $images = is_string($item->package_image) ? json_decode($item->package_image, true) : $item->package_image;
                        $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                    @endphp
                    <div class="col-xl-4 col-md-6">
                        <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                            data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                @if ($displayImage)
                                    <img src="{{ asset('storage/' . $displayImage) }}" alt="{{ $item->package_name }}"
                                        class="gallery-image">
                                @else
                                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image">
                                @endif
                                <div class="ratting">{{ $item->package_type }}</div>
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i>
                                        {{ $item->package_country }}</span>
                                </div>
                                <h5 class="card-heading">{{ $item->package_name }}</h5>
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i> {{ $item->package_duration_days }} Days /
                                        {{ $item->package_duration_nights }} Nights</li>
                                </ul>
                                <div class="destination-footers">
                                    <a href="{{ route('tourDetailpage', ['slug' => $item->slug]) }}"
                                        class="theme-btn style-two style-three">
                                        <span data-hover="View More">View More</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No Packages Found.</p>
            @endif
        </div> --}}
        <section class="tour-grid-page py-100 rel z-2">
            <div class="blog-banner" style="margin-bottom:50px; ">
                <img src="./assets/images/bannerblog.jpg" alt="" style="max-height:200px;width:100%; object-fit:cover;">
            </div>
            <div class="container">
                <div class="row">
                    <h2 class="text-center pb-20">Our Packages</h2>
                    @if ($packages && count($packages) > 0)
                        @foreach ($packages as $item)
                            @php
                                $images = is_string($item->package_image) ? json_decode($item->package_image, true) : $item->package_image;
                                $displayImage = is_array($images) && !empty($images) ? $images[0] : null;
                            @endphp
                            <div class="col-xl-4 col-md-6">
                                <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                                    data-aos-duration="1500" data-aos-offset="50">
                                    <div class="image">
                                        @if ($displayImage)
                                            <img src="{{ asset('storage/' . $displayImage) }}" alt="{{ $item->package_name }}"
                                                class="gallery-image">
                                        @else
                                            <img src="{{ asset('path/to/default/image.jpg') }}" alt="Default Image">
                                        @endif
                                        <div class="ratting">{{ $item->package_type }}</div>
                                    </div>
                                    <div class="content">
                                        <div class="destination-header">
                                            <span class="location"><i class="fal fa-map-marker-alt"></i>
                                                {{ $item->package_country }}</span>
                                        </div>
                                        <h5 class="card-heading">{{ $item->package_name }}</h5>
                                        <ul class="blog-meta">
                                            <li><i class="far fa-clock"></i> {{ $item->package_duration_days }} Days /
                                                {{ $item->package_duration_nights }} Nights</li>
                                        </ul>
                                        <div class="destination-footers">
                                            <a href="{{ route('tourpage', ['slug' => $item->slug]) }}"
                                                class="theme-btn style-two style-three">
                                                <span data-hover="View More">View More</span>
                                                <i class="fal fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No Packages Found.</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
