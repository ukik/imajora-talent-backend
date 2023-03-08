@extends('home.layouts.app')

@section('content')

<!-- Page section -->
<section class="page-section single-blog-page spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                {{-- <div class="blog-thumb set-bg" data-setbg="{{ asset($game->thumbnail) }}">
                    <div class="cata new">{{ $game->genre->title }}</div>
                </div> --}}
                <div class="text-center">
                    <img src="{{ asset($game->thumbnail) }}" class="img-fluid" width="750" height="375" alt="">
                </div>
            </div>
        </div>
        <div id="details" class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="blog-content">
                    <h3>{{ $game->title }}</h3>
                    <small class="text-muted text-capitalize">
                        <i class="fa fa-pencil"></i>
                        {{ $game->user->name }}
                    </small>
                    <small class="text-muted ml-2">| {{ $game->created_at->format('d, M Y') }}</small>
                    <div class="mt-4">
                        {!! $game->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-lg-8">
                <hr class="my-1">
                <ul class="contact-info-list text-capitalize">
                    <li>
                        <div class="cf-left">Game</div>
                        <div class="cf-right">{{ $game->title }}</div>
                    </li>
                    <li>
                        <div class="cf-left">Description</div>
                        <div class="cf-right">{{ $game->description }}</div>
                    </li>
                    <li>
                        <div class="cf-left">Genre</div>
                        <div class="cf-right">{{ $game->genre->title }}</div>
                    </li>
                    <li>
                        <div class="cf-left">Device</div>
                        @foreach ($game->devices as $device)
                            @if ($device->title == 'mobile')
                                <div class="cf-right">
                                    <span class="badge badge-secondary">
                                        {{ $device->title }}
                                    </span>
                                </div>
                            @else
                                <div class="cf-right">
                                    <span class="badge badge-secondary">
                                        {{ $device->title }}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </li>
                </ul>
                <iframe width="100%" height="315" src="{{ $game->trailer }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<!-- Page section end -->

<section class="review-section review-dark spad set-bg" data-setbg="{{ asset('assets/img/review-bg-2.jpg') }}">
    <div class="container">
        <div class="section-title text-white">
            <h2>Game Lainnya</h2>
        </div>
        <div class="row text-white">
            @foreach ($games as $game)
                <div class="col-lg-3 col-md-6">
                    <div class="review-item">
                        <div class="review-cover set-bg" data-setbg="{{ asset($game->thumbnail) }}">
                            <div class="cata new">{{ $game->genre->title }}</div>
                        </div>
                        <div class="review-text">
                            <h5><a href="{{ url("/game/$game->slug#details") }}" class="text-white">{{ $game->title }}</a></h5>
                            <p>{{ Str::limit($game->description, 60, '...') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
