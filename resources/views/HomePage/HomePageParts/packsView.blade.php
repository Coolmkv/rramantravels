<div class="tours-block-one package-card-section">
    <div class="inner-box">
        <div class="image-box">
            <figure class="image"><img src="{{ asset($pack->package_image) }}" alt="{!! $pack->package_name !!}" alt=""></figure>
            <span class="rating"><img src="assets/images/icons/icon-1.png" alt=""> 4.8</span>
        </div>
        <div class="lower-content">
            @if(count($pack->itinerary))
                @foreach ($pack->itinerary as $pi)
                <h6>{{ $pi->days."D ".$pi->city->city_name??'' }}</h6>
                @endforeach
            @endif
            <h4><a href="#">{!! $pack->package_name !!}</a></h4>
            <h5><i class="fa-solid fa-indian-rupee-sign"></i> {!! IND_money_format($pack->package_offer_price) !!} <span class="sale-price"><i class="fa-solid fa-indian-rupee-sign"></i> {!! IND_money_format($pack->package_price) !!}</span><span class="offer-amount">Save <i class="fa-solid fa-indian-rupee-sign"></i> {{ IND_money_format($pack->package_price-$pack->package_offer_price) }}</span></h5>
            <span class="day-time"><i class="icon-1"></i>{!! $pack->package_duration_days !!} Days / {!! $pack->package_duration_nights !!} Nights</span>
            <div class="link"><a href="#">Explore more<i class="fas fa-long-arrow-right"></i></a></div>
            {{-- <div class="link"><a href="{{$pack->package_external_link}}">Explore more<i class="fas fa-long-arrow-right"></i></a></div> --}}
        </div>
    </div>
</div>