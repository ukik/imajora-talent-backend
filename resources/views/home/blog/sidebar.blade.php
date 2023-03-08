<div class="col-lg-4 col-md-7 sidebar pt-5 pt-lg-0">
    <!-- widget -->
    <div class="widget-item">
        <h4 class="widget-title">Latest Posts</h4>
        <div class="latest-blog">
            @forelse ($appsNews  as $posts)
                <div class="lb-item">
                    @if ($posts->thumbnail)
                        <div class="lb-thumb set-bg" data-setbg="{{ asset($posts->thumbnail) }}"></div>
                    @else
                        <div class="lb-thumb set-bg" data-setbg="{{ asset('/dummy/news-dummy.png') }}">
                        </div>
                    @endif
                    <div class="lb-content">
                        <div class="lb-date">{{ $posts->created_at->format('d, M Y') }}</div>
                        <p class="text-capitalize"><a href="{{ url("/blog/$posts->slug") }}"
                                class="text-dark">{{ $posts->title }}</a></p>
                        <span class="lb-author text-capitalize">By {{ $posts->user->name }}</span>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <!-- widget -->
    <div class="widget-item">
        <h4>Category</h4>
        <div class="top-comment">
            @foreach ($categories as $category)
                <div class="cata new my-1"><a href="{{ url("/blog/category/$category->slug") }}"
                        class="text-white">{{ $category->title }}</a></div>
            @endforeach
        </div>
    </div>
    <div class="widget-item">
        <h4>Tags</h4>
        <div class="top-comment">
            @foreach ($tags as $tag)
                <span class="badge badge-warning"><a href="{{ url("/blog/tag/$tag->slug") }}"
                        class="text-white">{{ $tag->title }}</a></span>
            @endforeach
        </div>
    </div>
</div>
