@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Gallery</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/talent/' . Auth::user()->slug) }}">Talent</a></li>
                    <li class="breadcrumb-item active">Create Gallery</li>
                </ol>
            </nav>

            {{-- Alert ketika gagal membuat data gallery --}}
            {{-- @error('image')
                <div id="flash" data-flash="{{ $message }}"></div>
            @enderror --}}

            {{-- Alert Success --}}
            <div id="flash" data-flash="{{ session('success') }}"></div>
            {{-- /Alert Success --}}


            <div class="row my-2">
                <div class="col-lg-12">
                    <a href="{{ url('/admin/talent/' . Auth::user()->slug) }}" class="btn btn-round btn-light">
                        <i class="fas fa-undo"></i>
                        Back
                    </a>
                    <button type="button" class="btn btn-outline-primary btn-round" data-toggle="modal"
                        data-target="#modalNewAlbum">
                        <i class="far fa-images"></i>
                        New Album
                    </button>
                    @include('admin.gallery.new_album')
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="my-2">
                                <h1>Create Gallery</h1>
                                <hr class="my-2">
                            </div>
                            <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-4 text-center">
                                        <div class="form-group">
                                            <div class="input-file input-file-image">
                                                <img class="img-upload-preview avatar-img" width="200"
                                                    src="{{ asset('/gallery/blank-image.jpg') }}" alt="preview">
                                                <input type="file" class="form-control form-control-file" id="uploadImg1"
                                                    name="image" accept="image/*">
                                                <label for="uploadImg1" class="ml-3 label-input-file btn btn-primary">
                                                    <span class="btn-label">
                                                        <i class="fa fa-file-image"></i>
                                                    </span>
                                                    Upload Image
                                                </label>
                                            </div>
                                            @error('image')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Album</label>
                                            <select name="album" class="form-control">
                                                <option value="">-Select Album-</option>
                                                @foreach ($albums as $album)
                                                    <option value="{{ $album->id }}"
                                                        class="@if ($album->photos->count() === 20) <?php echo 'text-info'; ?> @endif"
                                                        @if ($album->photos->count() === 20) <?php echo 'disabled'; ?> @endif>
                                                        {{ $album->name }}
                                                        ({{ $album->photos->count() ?? '0' }}/20)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('album')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group float-right">
                                            <button type="submit" class="btn btn-primary btn-round">Post</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var flash = $('#flash').data('flash');
        if (flash) {
            swal("Success", "{{ session('success') }}", {
                icon: "success",
                buttons: {
                    confirm: {
                        className: 'btn btn-primary btn-round'
                    }
                },
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            var maxUpload = 0;

            $('.add_project_file').click(function(e) {
                e.preventDefault();

                maxUpload++
                if (maxUpload < 5) {
                    $(".project_images").append(
                        '<li>' +
                        '<input type="file" name="image[]" class="my-2" placeholder="Choose image" multiple required> ' +
                        '<a href="#" class="remove_project_file" border="2"><i class="fas fa-trash text-danger"></i></a>' +
                        '</li>');
                } else {
                    $('#max_upload').show();
                }

            });

            // Remove parent of 'remove' link when link is clicked.
            $('.project_images').on('click', '.remove_project_file', function(e) {
                e.preventDefault();

                $(this).parent().remove();
            });

        });
    </script>
@endpush
