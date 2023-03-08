<div class="row py-4">
    <div class="col-md-4">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle dropdown-album" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Semua
            </button>
            <div class="dropdown-menu select-album" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-item" onclick="updateSelectedAlbum(this)">Semua</div>
            </div>
        </div>
    </div>
</div>
<div class="row py-4">
    @foreach ($photos as $photo)
    <div class="col-md-4 my-2 gallery-item d-none">
        @if ($photo->image == 'null')
        <img class="img-fluid rounded" width="400px" src="{{ asset('/dummy/gallery-dummy.png') }}" alt="preview">
        @else
        <img class="img-fluid rounded" width="400px" src="{{ asset('uploads/gallery/photos_user_' . $profile->id . '/' . $photo->image) }}" alt="preview">
        @endif
        <div class="media position-relative my-4">
            @if ($photo->users->avatar)
            <img src="{{ asset('uploads/avatars/' . $photo->users->avatar) }}" class="mr-3 rounded-circle" width="50px" height="50px" alt="...">
            @else
            <img src="{{ asset('/user/anonim.jpg') }}" class="mr-3 rounded-circle" width="50px" height="50px" alt="...">
            @endif
            <div class="media-body">
                <h5 class="mt-0">{{ $photo->users->name }}</h5>
                <small>{{ $photo->created_at->format('d, M Y') }}
                    <a href="{{ $photo->albums->id }}"><i>Album {{ $photo->albums->name }}</i></a>
                </small>
                <p>{{ $photo->description }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-mg-12">
        <div class="my-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination gallery-pagination"></ul>
            </nav>
        </div>
    </div>
</div>

@push('script')
<script>
    const photos = $('.gallery-item');

    $(document).ready(function() {
        const albums = [...new Set([...photos].map((photo) => photo.querySelector('i').textContent.split(' ')[1]))];
        for (const album of albums) {
            const option = $('<div class="dropdown-item" onclick="updateSelectedAlbum(this)">' + album + '</div>');
            $('.select-album').append(option);
        }
        renderPaginations(photos);
    });

    function updateSelectedAlbum(elem) {
        const selectedAlbum = elem.textContent;
        document.querySelector('.dropdown-album').textContent = selectedAlbum;
        const filteredPhotos = [...photos].filter((photo) => photo.querySelector('i').textContent.split(' ')[1] === selectedAlbum);
        renderPaginations(selectedAlbum === 'Semua' ? photos : filteredPhotos);
    }

    function renderPaginations(items) {
        for (const photo of photos) {
            photo.classList.add('d-none');
        }
        const pageBtn = Math.ceil(items.length / 3);
        const pagination = $('ul.pagination.gallery-pagination');
        pagination.empty();
        const prevButton = $('<li class="page-item"><a class="page-link">Previous</a></li>');
        const buttons = [];
        let page = 1;
        for (let i = 0; i < pageBtn; i++) {
            const button = $('<li class="page-item"><a class="page-link">' + (i + 1) + '</a></li>');
            buttons.push(button);
        }
        const nextButton = $('<li class="page-item"><a class="page-link">Next</a></li>');
        if (buttons.length > 1) {
            pagination.append(prevButton);
            prevButton.click(function() {
                setActive(page - 1);
            });
            nextButton.click(function() {
                setActive(page + 1);
            });
            for (let i = 0; i < buttons.length; i++) {
                pagination.append(buttons[i]);
                buttons[i].click(function() {
                    setActive(i + 1);
                });
            }
            pagination.append(nextButton);
        }

        function setActive(index) {
            if (index <= 0 || index > pageBtn) {
                return;
            }
            buttons[page - 1]?.removeClass('active');
            for (let i = 0; i < 3; i++) {
                const p = (page - 1) * 3;
                items[p + i]?.classList?.add('d-none');
            }
            buttons[index - 1]?.addClass('active');
            for (let i = 0; i < 3; i++) {
                const p = (index - 1) * 3;
                items[p + i]?.classList?.remove('d-none');
            }
            page = index;
        }
        setActive(1);
    }
</script>
@endpush