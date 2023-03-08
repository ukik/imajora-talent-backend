<div class="row pt-4">
    <div class="col-lg-12 float-right">
        <div class="row float-right">
            <div class="col-mg-12">
                <div class="my-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination notice-pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        @foreach ($notices as $notice)
            <div class="col-sm-12 d-none notice-item">
                <div class="media position-relative">
                    @if ($notice->user->avatar)
                        <img class="mr-3 rounded-circle" width="50px" height="50px"
                            src="{{ asset('uploads/avatars/' . $notice->user->avatar) }}" alt="preview">
                    @else
                        <img src="{{ asset('/user/anonim.jpg') }}" class="mr-3 rounded-circle" width="50px"
                            height="50px" alt="...">
                    @endif


                    <div class="media-body">
                        <h5 class="mt-0">{{ $notice->user->name }}</h5>
                        <small>{{ $notice->created_at->format('d, M Y') }}</small>
                        <p>{{ $notice->content }}</p>
                        @include('home.notice.like', ['model' => $notice])
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            const items = $('.notice-item');
            const pageBtn = Math.ceil(items.length / 5);
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
                for (let i = 0; i < 5; i++) {
                    const p = (page - 1) * 5;
                    items[p + i]?.classList?.add('d-none');
                }
                buttons[index - 1]?.addClass('active');
                for (let i = 0; i < 5; i++) {
                    const p = (index - 1) * 5;
                    items[p + i]?.classList?.remove('d-none');
                }
                page = index;
            }
            setActive(1);
        });
    </script>
@endpush
