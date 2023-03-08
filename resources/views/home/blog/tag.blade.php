@extends('home.layouts.app')

@section('content')
    <section class="page-section recent-game-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <form class="search-widget" action="/blog">
                            <input type="text" name="search" placeholder="Search" value="{{ $search }}">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-6">
                                <div class="recent-game-item">
                                    @if ($post->thumbnail)
                                        <div class="rgi-thumb set-bg" data-setbg="{{ url($post->thumbnail) }}">
                                            <div class="cata new">{{ $post->category->title }}</div>
                                        </div>
                                    @else
                                        <div class="rgi-thumb set-bg" data-setbg="{{ asset('/dummy/news-dummy.png') }}">
                                            <div class="cata new">{{ $post->category->title }}</div>
                                        </div>
                                    @endif
                                    <div class="rgi-content">
                                        <h5 class="text-capitalize"><a href="{{ url("/blog/$post->slug") }}"
                                                class="text-dark">{{ $post->title }}</a></h5>
                                        <p>{{ Str::limit($post->description, 100, '...') }}</p>
                                        <span class="comment">{{ $post->created_at->format('d, M Y') }}</span>
                                        <div class="float-right">
                                            <span class="comment text-capitalize">By {{ $post->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center">
                                <h5>Postingan dengan tag "{{ $tag->title }}" tidak ditemukan</h5>
                            </div>
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center pt-4">
                        {{ $posts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                <!-- sidebar -->
                @include('home.blog.sidebar')
                <!-- /sidebar -->
            </div>
        </div>
    </section>
@endsection
