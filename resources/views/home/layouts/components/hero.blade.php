<section class="hero-section">
    <div class="hero-slider owl-carousel">
        @foreach ($hero as $carousel)
            @if ($carousel->id == 1)
                <div class="hs-item set-bg" data-setbg="{{ asset($carousel->image) }}">
                    <div class="hs-text">
                        <div class="container">
                            <h2>{{ $carousel->title }}</h2>
                            <p>{!! $carousel->description !!}</p>
                            <a href="{{ url('/game') }}" class="site-btn">Read More</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="hs-item set-bg" data-setbg="{{ asset($carousel->image) }}">
                    <div class="hs-text">
                        <div class="container">
                            <h2>{{ $carousel->title }}</h2>
                            <p>{!! $carousel->description !!}</p>
                            <a href="{{ url('/blog') }}" class="site-btn">Read More</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
