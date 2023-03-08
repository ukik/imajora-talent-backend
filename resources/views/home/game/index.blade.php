@extends('home.layouts.app')

@section('content')
    <!-- Page section -->
    <section class="page-section review-page spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="text-dark text-center">
                    <h2>Genre</h2>
                </div>
            </div>
            <div class="row text-white d-flex justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    @foreach ($genres as $genre)
                        <div class="cata new my-2 ms-2">
                            <a href="{{ url("/game/genre/$genre->slug") }}">{{ $genre->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                @forelse ($games as $game)
                    <div class="col-md-6">
                        <div class="review-item">
                            @if ($game->thumbnail)
                                <div class="review-cover set-bg" data-setbg="{{ url($game->thumbnail) }}">
                                    <div class="cata new">{{ $game->genre->title }}</div>
                                </div>
                            @else
                                <div class="review-cover set-bg" data-setbg="{{ asset('/dummy/game-dummy.png') }}">
                                    <div class="cata new">{{ $game->genre->title }}</div>
                                </div>
                            @endif
                            <div class="review-text">
                                <h4><a href="{{ url("/game/$game->slug#details") }}"
                                        class="text-dark">{{ $game->title }}</a></h4>
                                <p>{!! Str::limit($game->description, 100, '...') !!}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md text-center text-dark">
                        <h5><i>Belum terdapat game</i></h5>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center pt-4">
                {{ $games->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
    <!-- Page section end -->
@endsection
