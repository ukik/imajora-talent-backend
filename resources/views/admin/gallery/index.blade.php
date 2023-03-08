<div class="row pb-4">
    @foreach ($galleryPhoto as $photo)
        <div class="col-md-4 my-2">
            @if ($photo->image == 'null')
                <img class="img-fluid" width="400px" src="{{ asset('/dummy/gallery-dummy.png') }}" alt="preview">
            @else
                <img class="img-fluid" width="400px"
                    src="{{ asset('uploads/gallery/photos_user_' . $photo->users->id . '/' . $photo->image) }}"
                    alt="preview">
            @endif
            <form id="form-delete-gallery-{{ $photo->id }}" action="{{ route('photo.destroy', $photo->id) }}"
                method="post">
                @csrf
                @method('DELETE')
            </form>
            <div class="media position-relative my-4">
                @if ($photo->users->avatar)
                    <img class="mr-3 rounded-circle" width="50px" height="50px"
                        src="{{ asset('/uploads/avatars/' . $photo->users->avatar) }}" alt="preview">
                @else
                    <img src="{{ asset('/user/anonim.jpg') }}" class="mr-3 rounded-circle" width="50px" height="50px"
                        alt="...">
                @endif

                <div class="media-body">
                    <h5 class="mt-0">{{ $photo->users->name }}</h5>
                    <small class="text-muted">{{ $photo->created_at->format('d, M Y') }}</small>
                    <p>{{ $photo->description }}</p>
                </div>
                <div class="form-group float-right">
                    <button type="button" class="btn btn-link text-danger"
                        onclick="deleteGallery({{ $photo->id }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('scripts')
    {{-- button deleted sweet alert --}}
    <script>
        function deleteGallery(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Yes, delete it!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $('#form-delete-gallery-' + id).submit();
                } else {
                    swal.close();
                }
            });
        }
    </script>
@endpush
