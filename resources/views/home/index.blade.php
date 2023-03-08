@extends('home.layouts.app')

@section('hero')
    @include('home.layouts.components.hero')
@endsection

@section('content')
    {{-- All Users Profile --}}
    <div class="bbb_viewed">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="bbb_main_container">
                        <div class="bbb_viewed_slider_container">
                            <div class="owl-carousel owl-theme bbb_viewed_slider">
                                @foreach ($talentProfiles as $profile)
                                    <div class="owl-item">
                                        <div
                                            class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="bbb_viewed_image">
                                                @if ($profile->avatar)
                                                    <img src="{{ asset('uploads/avatars/' . $profile->avatar) }}"
                                                        class="rounded-circle text-center" alt="">
                                                @else
                                                    <img src="{{ asset('/user/anonim.jpg') }}"
                                                        class="rounded-circle text-center" alt="">
                                                @endif
                                            </div>
                                            <div class="bbb_viewed_content text-center">
                                                <div class="bbb_viewed_name text-capitalize"><a
                                                        href="{{ route('talent.profile', $profile->slug) }}">{{ $profile->name }}</a>
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
        </div>
    </div>
    {{-- /All Users Profile --}}

    <!-- Feature section -->
    <section class="feature-section spad">
        <div class="container">
            <div class="row">
                @forelse ($latestNews as $posts)
                    <div class="col-lg-3">
                        @if ($posts->thumbnail)
                            <div class="feature-item set-bg" data-setbg="{{ asset($posts->thumbnail) }}">
                            @else
                                <div class="feature-item set-bg" data-setbg="{{ asset('dummy/news-dummy.png') }}">
                        @endif

                        <span class="cata new">{{ $posts->category->title }}</span>
                        <div class="fi-content text-white">
                            <h5><a href="{{ url("/blog/$posts->slug") }}">{{ $posts->title }}</a></h5>
                            <p>{!! Str::limit($posts->description, 60, '...') !!}</p>
                            <span class="fi-comment">{{ $posts->created_at->format('d, M Y') }}</span>
                        </div>
                    </div>
            </div>
        @empty
            <div class="col-lg p-0">
                <h5>Belum terdapat postingan</h5>
            </div>
            @endforelse
        </div>
        <div class="section-title pt-4">
            <a href="{{ url('/blog') }}" class="text-muted">Tampilkan lebih banyak</a>
        </div>
        </div>
    </section>
    <!-- Feature section end -->


    <!-- Recent game section  -->
    <section class="recent-game-section spad set-bg" data-setbg="{{ asset($app->bg_recent_game) }}">
        <div class="container">
            <div class="section-title">
                <div class="cata new">new</div>
                <h2>Recent Games</h2>
            </div>
            <div class="row">
                @forelse ($latestGames as $games)
                    <div class="col-lg-4 col-md-6">
                        <div class="recent-game-item">
                            @if ($games->thumbnail)
                                <div class="rgi-thumb set-bg" data-setbg="{{ asset($games->thumbnail) }}">
                                @else
                                    <div class="rgi-thumb set-bg" data-setbg="{{ asset('dummy/game-dummy.png') }}">
                            @endif
                            <div class="cata new">{{ $games->genre->title }}</div>
                        </div>
                        <div class="rgi-content">
                            <h5><a href="{{ url("/game/$games->slug#details") }}"
                                    class="text-dark">{{ $games->title }}</a></h5>
                            <p>{!! Str::limit($games->description, 60, '...') !!}</p>
                            <span class="fi-comment">{{ $games->created_at->format('d, M Y') }}</span>
                        </div>
                    </div>
            </div>
        @empty
            <div class="col-lg p-0">
                <h5 class="text-center">Belum terdapat game</h5>
            </div>
            @endforelse
        </div>
        <div class="section-title pt-4">
            <a href="{{ url('/game') }}" class="text-muted">Tampilkan lebih banyak</a>
        </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {


            if ($('.bbb_viewed_slider').length) {
                var viewedSlider = $('.bbb_viewed_slider');

                viewedSlider.owlCarousel({
                    loop: true,
                    margin: 30,
                    autoplay: true,
                    autoplayTimeout: 6000,
                    nav: false,
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        575: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        991: {
                            items: 4
                        },
                        1199: {
                            items: 6
                        }
                    }
                });

                if ($('.bbb_viewed_prev').length) {
                    var prev = $('.bbb_viewed_prev');
                    prev.on('click', function() {
                        viewedSlider.trigger('prev.owl.carousel');
                    });
                }

                if ($('.bbb_viewed_next').length) {
                    var next = $('.bbb_viewed_next');
                    next.on('click', function() {
                        viewedSlider.trigger('next.owl.carousel');
                    });
                }
            }


        });
    </script>
@endpush
