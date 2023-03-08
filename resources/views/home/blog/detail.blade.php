@extends('home.layouts.app')

@section('content')
    <section class="page-section single-blog-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <form class="search-widget" action="/blog">
                            <input type="text" name="search" placeholder="Search" value="{{ $search }}">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                    {{-- Shared Button --}}
                    {{-- <div class="my-3">
                    {!! $socialShare !!}
                </div> --}}

                    <h3 class="text-capitalize">
                        {{ $post->title }}
                    </h3>

                    <div class="my-3">
                        @if ($post->user->avatar)
                            <img src="{{ asset('uploads/avatars/' . $post->user->avatar) }}"
                                class="img-fluid rounded-circle" width="50" alt="">
                        @else
                            <img src="{{ asset('/user/anonim.jpg') }}" class="img-fluid rounded-circle" width="50"
                                alt="">
                        @endif

                        <span class="text-monospace text-capitalize"><small class="text-muted">By
                            </small>{{ $post->user->name }}</span>
                        {{-- date --}}
                        <small class="text-muted">| {{ $post->created_at->format('d, M Y') }}</small>
                        <a href="{{ url("/blog/$post->slug#comments") }}"
                            class="float-right text-dark font-weight-light mt-2">
                            <i class="fa fa-comment text-warning"></i>
                            {{ $post->comments->count() }}
                        </a>


                        {{-- tags --}}
                        <div style="margin-left: 45px;">

                            <a href="{{ url('/blog/category/' . $post->category->slug) }}">
                                <span class="badge badge-pill badge-danger">{{ $post->category->title }}</span>
                            </a>
                            <span> |
                                <i class="fa fa-tags"></i>
                                @foreach ($post->tags as $tag)
                                    {{-- <span class="text-decoration-none">{{ $tag->title }}</span> --}}
                                    <a href="{{ url("/blog/tag/$tag->slug") }}" class="text-secondary">
                                        <i>
                                            <small>{{ $tag->title }},</small>
                                        </i>
                                    </a>
                                @endforeach
                            </span>
                        </div>
                    </div>

                    @if ($post->thumbnail)
                        <img src="{{ asset($post->thumbnail) }}" class="img-fluid rounded" width="750" height="375"
                            alt="">
                    @else
                        <img src="{{ asset('/dummy/news-dummy.png') }}" class="img-fluid rounded" width="750"
                            height="375" alt="">
                    @endif

                    <div class="blog-content">
                        <div class="my-2 text-justify">
                            {!! $post->content !!}
                        </div>
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

                        {{-- Provider Comments --}}
                        <div class="row" id="facebook-comment">
                            <div class="col-lg">
                                <div class="fb-comments" data-href="https://wansite.tech/blog/{{ $post->slug }}"
                                    data-width="100%" data-numposts="5"></div>
                            </div>
                        </div>

                        <div class="row" id="guest-comment" style="display: none;">
                            <div class="col-lg">

                                {{-- form guest comment --}}
                                @include('home.comment.post.create')
                                {{-- /form guest comment --}}

                                <hr class="my-2">
                                {{-- List comment guest --}}
                                {{-- list komentar utama --}}
                                @foreach ($post->comments()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $comment)
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
                                                        data-toggle="collapse" data-target="#showReply-{{ $comment->id }}"
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
                                                    @include('home.comment.post.reply')
                                                    @include('home.comment.post.show-reply')
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
                        {{-- /Provider Comments --}}

                    </div>
                    {{-- /comment --}}


                    {{-- /Show Comment --}}
                </div>
                <!-- sidebar -->
                @include('home.blog.sidebar')
                <!-- /sidebar -->
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
