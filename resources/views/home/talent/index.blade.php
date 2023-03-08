@extends('home.layouts.app')

@section('content')
    <section class="page-section recent-game-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {{-- Header --}}
                    <div class="my-4">
                        <form action="/talent">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search"
                                    value="{{ $search }}">
                            </div>
                        </form>
                    </div>
                    @foreach ($usersTalent as $user)
                        <div class="row py-4 align-items-center d-none talent-item">

                            {{-- Avatar --}}
                            <div class="col-lg-3">
                                <div class="text-center">
                                    @if ($user->avatar)
                                        <img class="img-fluid rounded-circle" width="200px" height="200px"
                                            src="{{ asset('uploads/avatars/' . $user->avatar) }}" alt="preview">
                                    @else
                                        <img class="img-fluid rounded-circle" width="200px" height="200px"
                                            src="{{ asset('/user/anonim.jpg') }}" alt="preview">
                                    @endif
                                </div>
                            </div>

                            {{-- Full Name --}}
                            <div class="col-lg-8">
                                <a href="{{ url("/talent/$user->slug") }}" class="text-dark">
                                    <h3>{{ $user->name }}</h3>
                                </a>
                                @foreach ($user->skills as $skill)
                                    <span class="badge badge-pill badge-info">
                                        {{ $skill->title }}
                                    </span>
                                @endforeach
                                <p>
                                    {{ $user->description }}
                                </p>
                            </div>

                            <hr class="my-4">
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center pt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination talent-pagination"></ul>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-4">
                    {{-- Header --}}
                    <div class="my-4">
                        <h3>Notices</h3>
                    </div>

                    <div class="row">
                        @foreach ($notices as $notice)
                            <div class="col-sm-12">
                                <div class="media position-relative">
                                    @if ($notice->user->avatar)
                                        <img class="mr-3 rounded-circle" width="50px" height="50px"
                                            src="{{ asset('uploads/avatars/' . $notice->user->avatar) }}" alt="preview">
                                    @else
                                        <img src="{{ asset('/user/anonim.jpg') }}" class="mr-3 rounded-circle"
                                            width="50px" height="50px" alt="...">
                                    @endif


                                    <div class="media-body">
                                        <h5 class="mt-0">{{ $notice->user->name }}</h5>
                                        <small>{{ $notice->created_at->format('d, M Y') }}</small>
                                        <p>{{ $notice->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            const len = 10;
            const items = $('.talent-item');
            const pageBtn = Math.ceil(items.length / len);
            const pagination = $('ul.pagination.talent-pagination');
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
                for (let i = 0; i < len; i++) {
                    const p = (page - 1) * len;
                    items[p + i]?.classList?.add('d-none');
                }
                buttons[index - 1]?.addClass('active');
                for (let i = 0; i < len; i++) {
                    const p = (index - 1) * len;
                    items[p + i]?.classList?.remove('d-none');
                }
                page = index;
            }
            setActive(1);
        });

        function sendAjax(id, type, elem) {
            $.ajax({
                url: "{{ url('save-likedislike') }}",
                type: "post",
                dataType: 'json',
                data: {
                    notice: id,
                    type: type,
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function() {
                    elem.classList.add('disabled');
                },
                success: function(res) {
                    if (res.bool == true) {
                        elem.classList.remove('disabled');
                        elem.classList.add('active');
                        elem.innerText = 'Like ' + res.like
                    }
                }
            });
        }

        function saveLike(elem) {
            const id = elem.dataset.notice;
            sendAjax(id, 'like', elem);
        }

        function saveDislike(elem) {
            const id = elem.dataset.notice;
            sendAjax(id, 'dislike', elem);
        }
    </script>
@endpush
