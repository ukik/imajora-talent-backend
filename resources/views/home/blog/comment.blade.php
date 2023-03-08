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
                <h3 class="text-capitalize">
                    {{ $post->title }}
                </h3>

                <div class="my-3">
                    <img src="{{ asset('uploads/' . $post->user->avatar) }}" class="img-thumbnail rounded-circle" width="38" alt="">
                    <span class="text-monospace text-capitalize"><small class="text-muted">By </small>{{ $post->user->name }}</span>
                    {{-- date --}}
                    <small class="text-muted">| {{ $post->created_at->format('d, M Y') }}</small>
                    <a href="{{ url("/blog/$post->slug#comment") }}" class="float-right text-dark font-weight-light h4">
                        <i class="fa fa-comment text-warning"></i>
                        {{ $post->comments->count() }}
                    </a>


                    {{-- tags --}}
                    <div style="margin-left: 45px;">

                        <a href="{{ url("/blog/category/". $post->category->slug) }}">
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

                <img src="{{ asset($post->thumbnail) }}" class="img-fluid rounded" width="750" height="375" alt="">

                <div class="blog-content">
                    <div class="mt-4">
                        {!! $post->content !!}
                    </div>
                </div>

                {{-- Show Comment --}}
                <div id="comments" class="comment-form-warp">
                    <h4 class="comment-title">Leave Your Comment</h4>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- error captcha --}}
                    @if ($errors->has('g-recaptcha-response'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('g-recaptcha-response') }}
                        </div>
                    @endif
                    {{-- /error captcha --}}

                    {{-- Koemntar utama --}}
                    <div id="komentar" class="row">
                        <div class="col-lg-12">
                            @if (Auth::check())
                                <form action="{{ url("/blog/$post->slug") }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="parent" class="form-control" value="0" hidden>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your name.." value="{{ Auth::user()->name }}" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your email.." value="{{ Auth::user()->email }}" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea name="message" rows="3" class="form-control @if(!old('parent' == 0)) @error('message') is-invalid @enderror @endif" placeholder="Comment.." required></textarea>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group my-2">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-12 my-2">
                                            <button type="submit" class="btn btn-warning text-white">Sand</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form action="{{ url("/blog/$post->slug") }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="parent" class="form-control" value="0" hidden>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your name.." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your email.." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea name="message" rows="3" class="form-control @error('message') is-invalid @enderror" placeholder="Comment.." required></textarea>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group my-2">
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12 my-2">
                                            <button type="submit" class="btn btn-warning text-white">Sand</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    {{-- /Koemntar utama --}}


                </div>
                <div id="comment" class="comment-warp">
                    <h4 class="comment-title">Coments <span class="badge badge-warning text-white">{{ $post->comments->count() }}</span></h4>
                    <ul class="comment-list">
                        @foreach ($post->comments()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $comment)
                            <li>
                                <div class="comment">
                                    @if ($comment->user_id == null)
                                        <div class="comment-avator set-bg" data-setbg="{{ asset('assets/img/authors/1.jpg') }}"></div>
                                    @else
                                        <div class="comment-avator set-bg" data-setbg="{{ asset('uploads/' . $comment->user->avatar) }}"></div>
                                    @endif
                                    {{-- <div class="comment-avator set-bg" data-setbg="{{ asset('assets/img/authors/1.jpg') }}"></div> --}}
                                    <div class="comment-content">
                                        <h5>{{ $comment->name }} <span>{{ $comment->created_at->diffForHumans() }}</span></h5>
                                        <p>{{ $comment->message }} </p>

                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#showReply-{{ $comment->id }}"><small class="text-muted">
                                            <i>{{ $comment->childs->count() }} reply</i></small>
                                        </button>
                                        <button class="reply btn btn-link" type="button" data-toggle="collapse" data-target="#replyInput-{{ $comment->id }}">Reply</button>

                                        {{-- Koemntar Reply --}}
                                        <div class="row collapse @if($errors->all()) show @endif" id="replyInput-{{ $comment->id }}">
                                            <div class="col-12">
                                                @if (Auth::check())
                                                    <form action="{{ url('/blog/' . $comment->post->slug) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    {{-- parent id --}}
                                                                    <input type="text" name="parent" class="form-control" value="{{ $comment->id }}" hidden>
                                                                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Your name.." value="{{ Auth::user()->name }}" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Your email.." value="{{ Auth::user()->email }}" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <small class="text-primary"><i>Membalas {{ $comment->name }}..</i></small>
                                                                <input type="text" name="message" class="form-control  @error('message') is-invalid @enderror" placeholder="Comment.." required>
                                                            </div>
                                                            <div class="col-lg-6">
                                                            <div class="form-group my-2">
                                                                {!! NoCaptcha::renderJs() !!}
                                                                {!! NoCaptcha::display() !!}
                                                            </div>
                                                        </div>
                                                            <div class="col-lg-12 my-2">
                                                                <button type="submit" class="btn btn-warning text-white">Sand</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form action="{{ url('/blog/' . $comment->post->slug) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" name="parent" class="form-control" value="{{ $comment->id }}" hidden>
                                                                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Your name.." required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Your email.." required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <small class="reply"><i>Membalas {{ $comment->name }}..</i></small>
                                                                <input type="text" name="message" class="form-control  @error('message') is-invalid @enderror" placeholder="Comment.." required>
                                                            </div>
                                                            <div class="col-lg-6">
                                                            <div class="form-group my-2">
                                                                {!! NoCaptcha::renderJs() !!}
                                                                {!! NoCaptcha::display() !!}
                                                            </div>
                                                        </div>
                                                            <div class="col-lg-12 my-2">
                                                                <button type="submit" class="btn btn-warning text-white">Sand</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- Koemntar Reply --}}



                                        <div class="collapse" id="showReply-{{ $comment->id }}">
                                            @foreach ($comment->childs as $child)
                                            <div class="my-4">
                                                <div class="comment">
                                                    @if ($child->user_id == null)
                                                        <div class="comment-avator set-bg" data-setbg="{{ asset('assets/img/authors/1.jpg') }}"></div>
                                                    @else
                                                        <div class="comment-avator set-bg" data-setbg="{{ asset('uploads/' . $child->user->avatar) }}"></div>
                                                    @endif
                                                    <div class="comment-content">
                                                        <h5>{{ $child->name }} <span>{{ $child->created_at->diffForHumans() }}</span></h5>
                                                        <p>{{ $child->message }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                            </li>
                        @endforeach
                    </ul>
                </div>


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

@endpush
