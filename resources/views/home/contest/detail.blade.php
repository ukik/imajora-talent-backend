@extends('home.layouts.app')

@section('content')
    <section class="page-section recent-game-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ url('/contest/' . $contest->slug) }}" class="text-dark">
                        <h2 class="text-capitalize">{{ $contest->title }}</h2>
                    </a>
                    <div class="my-4">
                        @if ($contest->users->avatar)
                            <img src="{{ asset('uploads/avatars/' . $contest->users->avatar) }}"
                                class="img-fluid rounded-circle" width="36" alt="">
                        @else
                            <img src="{{ asset('/user/anonim.jpg') }}" class="img-fluid rounded-circle" width="36"
                                alt="">
                        @endif
                        <span class="text-capitalize ml-2"> {{ $contest->users->name }} </span>
                        <i class="text-muted"><small>{{ $contest->created_at->format('d, M Y') }} </small></i>
                        <div class="my-1" style="margin-left: 45px;">
                            <span class="badge badge-danger">{{ $contest->categories->title }}</span>
                            <span>|</span>
                            <i class="fa fa-tags"></i>
                            @foreach ($contest->tags as $tag)
                                <a href="http://" class="text-muted">
                                    <i>{{ $tag->title }}</i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @if ($contest->thumbnail == 'null')
                        <img src="{{ asset('/dummy/contest-dummy.jpg') }}" class="img-fluid" alt="..." width="1080px"
                            height="720px">
                    @else
                        <img src="{{ $contest->thumbnail }}" class="img-fluid" alt="..." width="1080px" height="720px">
                    @endif
                </div>
                <div class="my-4">
                    {!! $contest->content !!}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr class="py-4">
                    <h3>Live Streaming</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe width="100%" height="400" src="{{ $contest->link_embed_youtube }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>#Comments</h3>
                                </div>
                                <div class="card-body">
                                    @auth
                                        <div class="form-group">
                                            <label style="color: #ff205f"
                                                class="text-capitalize">{{ Auth::user()->name }}</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="user_id" value="{{ Auth::user()->id }}" hidden>
                                                <input type="text" id="contest_id" value="{{ $contest->id }}" hidden>
                                                <input type="text" id="message" name="message" class="form-control"
                                                    placeholder="Comments" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-warning" type="button" id="store">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endauth

                                    @guest
                                        <div class="form-group">
                                            <a href="{{ route('login') }}">Untuk dapat berkomentar harap login terlebih
                                                dahulu</a>
                                        </div>
                                    @endguest

                                    <div class="overflow-auto anyClass" id="list-comments">
                                        @foreach ($contest->comments()->where('contest_id', $contest->id)->orderBy('created_at', 'desc')->get() as $comment)
                                            <h6>{{ $comment->users->name }}</h6>
                                            <p>{{ $comment->message }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        // action store comment
        $('#store').click(function(e) {
            e.preventDefault();

            // define variable
            let userId = $('#user_id').val();
            let contestId = $('#contest_id').val();
            let message = $('#message').val();
            let token = $("meta[name='csrf-token']").attr("content");

            //ajax
            $.ajax({
                url: `/contest/store/comments`,
                type: "POST",
                cache: false,
                data: {
                    "userId": userId,
                    "contestId": contestId,
                    "message": message,
                    "_token": token
                },
                success: function(response) {

                    //data comment
                    let comment = `
                            <h6>${response.data.name}</h6>
                            <p>${response.data.message}</p>
                    `;

                    //append to table
                    $('#list-comments').prepend(comment);

                    //clear form
                    $('#message').val('');

                },
                error: function(error) {

                    console.log('fails');

                }
            });
        });
    </script>
@endpush
