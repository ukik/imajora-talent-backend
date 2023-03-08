@extends('home.layouts.app')

@section('content')
    <!-- Page section -->
    <section class="page-section single-blog-page spad">
        <div class="container">


            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">

                    {{-- Head information --}}
                    <div class="my-2">
                        <h3>{{ $game->title }}</h3>
                    </div>

                    <div class="my-3">
                        @if ($game->user->avatar)
                            <img src="{{ asset('uploads/avatars/' . $game->user->avatar) }}" class="img-fluid rounded-circle"
                                width="50" alt="">
                        @else
                            <img src="{{ asset('/user/anonim.jpg') }}" class="img-fluid rounded-circle" width="50"
                                alt="">
                        @endif
                        <span class="text-monospace text-capitalize"><small class="text-muted">By
                            </small>{{ $game->user->name }}</span>
                        {{-- date --}}
                        <small class="text-muted">| {{ $game->created_at->format('d, M Y') }}</small>
                    </div>



                    {{-- thumbnail --}}
                    <div class="text-center">
                        @if ($game->thumbnail)
                            <img src="{{ $game->thumbnail }}" class="img-fluid rounded" width="1000px" height="375px"
                                alt="">
                        @else
                            <img src="{{ asset('/dummy/game-dummy.png') }}" class="img-fluid rounded" width="1000px"
                                height="375px" alt="">
                        @endif
                    </div>

                    {{-- content --}}
                    <div class="my-2 text-justify">
                        <span>
                            {!! $game->content !!}
                        </span>
                    </div>


                    <div>

                        <ul class="contact-info-list text-capitalize">
                            <h4 class="mb-3">
                                <i class="fa fa-gamepad"></i>
                                Game Info
                            </h4>

                            {{-- description --}}
                            <div class="my-4 text-center border rounded">
                                <footer class="blockquote-footer">Description</footer>
                                <p class="text-monospace">
                                    {{ $game->description }}
                                </p>
                            </div>

                            <li>
                                <div class="cf-left">Game</div>
                                <div class="cf-right">{{ $game->title }}</div>
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
                        <iframe width="100%" height="400" src="{{ $game->trailer }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>

                    {{-- comment --}}
                    <div class="comment-form-warp" id="comments">
                        <h4 class="comment-title">Leave Your Comment</h4>

                        @if (session('success'))
                            <div class="mb-4">
                                <span class="text-success">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if ($errors->has('g-recaptcha-response'))
                            <div class="mb-4">
                                <span class="text-danger">Comment failed send</span>
                            </div>
                        @endif

                        {{-- Button action --}}
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" id="btn-facebook-comment" class="btn btn-primary">
                                <i class="fa fa-facebook"></i>
                                with Facebook
                            </button>
                            <button type="button" id="btn-guest-comment" class="btn btn-light">
                                <i class="fa fa-users"></i>
                                with Guest
                            </button>
                        </div>

                        <div class="row" id="facebook-comment">
                            <div class="col-lg">
                                <div class="fb-comments" data-href="https://wansite.tech/game/{{ $game->slug }}"
                                    data-width="100%" data-numposts="5"></div>
                            </div>
                        </div>

                        <div class="row" id="guest-comment" style="display: none;">
                            <div class="col-lg">

                                {{-- form guest comment --}}
                                @include('home.comment.game.create')
                                {{-- /form guest comment --}}

                                <hr class="my-2">
                                {{-- List comment guest --}}
                                {{-- list komentar utama --}}
                                @foreach ($game->comments()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $comment)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="form-inline">
                                                    @if ($comment->user_id)
                                                        <img src="{{ asset('/uploads/avatars/' . $comment->user->avatar) }}"
                                                            class="img-fluid rounded-circle" width="43px" alt="">
                                                    @else
                                                        <img src="{{ asset('/user/anonim.jpg') }}"
                                                            class="img-fluid rounded-circle" width="43px" alt="">
                                                    @endif
                                                    <label class="font-weight-normal ml-4">{{ $comment->name }}<small
                                                            class="text-muted ml-2">{{ $comment->created_at->format('d, M Y') }}</small></label>
                                                </div>
                                                <p style="margin-left: 66px;" class="text-dark">
                                                    {{ $comment->message }}
                                                </p>

                                                {{-- List komentar reply --}}
                                                <div style="margin-left: 52px;">
                                                    <button class="btn btn-link text-muted" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#showReply-{{ $comment->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="showReply-{{ $comment->id }}">
                                                        Replies
                                                        <span>{{ $comment->where('parent', $comment->id)->count() }}</span>
                                                    </button>
                                                    <button class="btn btn-warning btn-sm text-white" type="button"
                                                        data-toggle="collapse" data-target="#reply-{{ $comment->id }}"
                                                        aria-expanded="false" aria-controls="reply-{{ $comment->id }}">
                                                        Reply
                                                    </button>
                                                    @include('home.comment.game.reply')
                                                    @include('home.comment.game.show-reply')
                                                </div>
                                                {{-- /List komentar reply --}}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                                {{-- /list komentar utama --}}
                                {{-- /List comment guest --}}

                            </div>
                        </div>

                    </div>
                    {{-- /comment --}}


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
                            @if ($game->thumbnail)
                                <div class="review-cover set-bg" data-setbg="{{ asset($game->thumbnail) }}">
                                    <div class="cata new">{{ $game->genre->title }}</div>
                                </div>
                            @else
                                <div class="review-cover set-bg" data-setbg="{{ asset('/dummy/game-dummy.png') }}">
                                    <div class="cata new">{{ $game->genre->title }}</div>
                                </div>
                            @endif
                            <div class="review-text">
                                <h5><a href="{{ url("/game/$game->slug#details") }}"
                                        class="text-white">{{ $game->title }}</a></h5>
                                <p>{{ Str::limit($game->description, 60, '...') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('script')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v14.0&appId=632097248280062&autoLogAppEvents=1"
        nonce="kFySQmG9"></script>

    <script>
        $(document).ready(function() {
            $('#btn-facebook-comment').click(function() {
                $('#facebook-comment').toggle('slide');
                $('#guest-comment').hide();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#btn-guest-comment').click(function() {
                $('#facebook-comment').hide();
                $('#guest-comment').toggle('slide');
            });
        });
    </script>
@endpush
