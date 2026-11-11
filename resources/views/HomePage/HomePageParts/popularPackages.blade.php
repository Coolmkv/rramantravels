@if (!empty($packageCategory["popular"]))

<section class="tours-section pt_100 pb_70">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
    <div class="auto-container">
        <div class="tabs-box">
            <div class="upper-box mb_60">
                <div class="sec-title">
                    <span class="sub-title">Packages</span>
                    <h2>Popular Packages</h2>
                </div>
            </div>
            <div class="tabs-content">
                <div class="tab active-tab" id="tab-1">
                    <div class="row clearfix populer-carousel owl-carousel">
                        @foreach ($packageCategory["popular"] as $item)
                            <div class="tours-block">
                                <div class="tours-block-one package-card-section">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><img src="{{ asset($item["package"]["package_image"]) }}" alt="{{ $item["package"]["package_name"] }}"></figure>
                                            <span class="rating" style="display: inline-flex"><img src="assets/images/icons/icon-1.png" alt=""> 4.8</span>
                                        </div>
                                        <div class="lower-content">
                                            @if(count($item["package"]["itinerary"]))
                                                @foreach ($item["package"]["itinerary"] as $pi)
                                                    <h6>{{ $pi["days"]."D ".$pi["city"]["city_name"]??'' }}</h6>
                                                @endforeach
                                                @endif
                                            <h4><a href="#">{{ $item["package"]["package_name"] }}</a></h4>
                                            <h5><i class="fa-solid fa-indian-rupee-sign"></i> {!! IND_money_format($item["package"]["package_offer_price"]) !!} <span class="sale-price"><i class="fa-solid fa-indian-rupee-sign"></i> {!! IND_money_format($item["package"]["package_price"]) !!}</span><span class="offer-amount">Save <i class="fa-solid fa-indian-rupee-sign"></i> {{ IND_money_format($item["package"]["package_price"]-$item["package"]["package_offer_price"]) }}</span></h5>
                                            <span class="day-time"><i class="icon-1"></i>{!! $item["package"]["package_duration_days"] !!} Days / {!!  $item["package"]["package_duration_nights"] !!} Nights</span>
                                            <div class="link"><a href="#">Explore more<i class="fas fa-long-arrow-right"></i></a></div>
                                            {{-- <div class="link"><a href="{{$pack->package_external_link}}">Explore more<i class="fas fa-long-arrow-right"></i></a></div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.populer-carousel .owl-nav{display: none}
</style>

@endif