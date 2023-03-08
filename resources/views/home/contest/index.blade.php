@extends('home.layouts.app')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($carouselContest as $carousel)
                <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                    @if ($carousel->thumbnail == 'null')
                        <img class="d-block w-100" src="{{ asset('/dummy/contest-dummy.jpg') }}" width="1153px"
                            height="720" alt="carousel">
                    @else
                        <img class="d-block w-100" src="{{ $carousel->thumbnail }}" width="1153px" height="720"
                            alt="carousel">
                    @endif
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="page-section recent-game-page spad">
        <div class="container">
            <div class="row">
                @foreach ($contests as $contest)
                    <div class="col-lg-6 item-custome-1 text-capitalize" style="padding-bottom: 50px;">
                        <a href="{{ url('/contest/' . $contest->slug) }}" class="text-dark">
                            <div class="my-4">
                                @if ($contest->thumbnail == 'null')
                                    <span class="notify-badge">{{ $contest->categories->title }}</span>
                                    <img src="{{ asset('/dummy/contest-dummy.jpg') }}" class="img-fluid" alt="..."
                                        width="1080px" height="720px">
                                @else
                                    <span class="notify-badge">{{ $contest->categories->title }}</span>
                                    <img src="{{ $contest->thumbnail }}" class="img-fluid" alt="..." width="1080px"
                                        height="720px">
                                @endif
                                <div class="my-2">
                                    <i class="text-muted"><small>{{ $contest->created_at->format('d, M Y') }} </small></i>
                                    <h4 class="text-capitalize">{{ Str::limit($contest->title, 45, '...') }}</h4>
                                    <h5 class="text-muted">{{ Str::limit($contest->description, 60, '...') }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center pt-4">
                        {{ $contests->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

{{-- @push('script')
    <script>
        $(document).ready(function() {
            const items = $('.contest-item');
            const pageBtn = Math.ceil(items.length / 2);
            const pagination = $('ul.pagination.notice-pagination');
            const prevButton = $('<li class="page-item"><a class="page-link">Previous</a></li>');
            const buttons = [];
            let page = 1;
            pagination.append(prevButton);
            for (let i = 0; i < pageBtn; i++) {
                const button = $('<li class="page-item"><a class="page-link">' + (i + 1) + '</a></li>');
                buttons.push(button);
                pagination.append(button);
            }
            const nextButton = $('<li class="page-item"><a class="page-link">Next</a></li>');
            pagination.append(nextButton);
            prevButton.click(function() {
                setActive(page - 1);
            });
            nextButton.click(function() {
                setActive(page + 1);
            });
            for (let i = 0; i < buttons.length; i++) {
                buttons[i].click(function() {
                    setActive(i + 1);
                });
            }

            function setActive(index) {
                if (index <= 0 || index > pageBtn) {
                    return;
                }
                buttons[page - 1]?.removeClass('active');
                for (let i = 0; i < 2; i++) {
                    const p = (page - 1) * 2;
                    items[p + i]?.classList?.add('d-none');
                }
                buttons[index - 1]?.addClass('active');
                for (let i = 0; i < 2; i++) {
                    const p = (index - 1) * 2;
                    items[p + i]?.classList?.remove('d-none');
                }
                page = index;
            }
            setActive(1);
        });
    </script>
@endpush --}}
