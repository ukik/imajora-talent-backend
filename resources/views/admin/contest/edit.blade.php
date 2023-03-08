@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Contest</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('contest.index') }}">Contest</a></li>
                    <li class="breadcrumb-item active">Edit Contest</li>
                </ol>
            </nav>

            {{-- Alert Success --}}
            <div id="flash" data-flash="{{ session('fails') }}"></div>
            {{-- /Alert Success --}}

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('contest.index') }}" class="btn btn-outline-primary btn-round">
                        <i class="fas fa-undo"></i>
                        Back
                    </a>
                </div>
                <div class="col-md-12 my-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('contest.update', $contest->slug) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Contest name..." value="{{ old('title', $contest->title) }}">
                                            @error('title')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Thumbnail</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button id="button_contest_thumbnail"
                                                        data-input="input_contest_thumbnail"
                                                        class="btn btn-primary btn-border" type="button">Upload</button>
                                                </div>
                                                <input id="input_contest_thumbnail" type="text" name="thumbnail"
                                                    class="form-control @error('thumbnail') is-invalid @enderror"
                                                    value="{{ old('thumbnail', $contest->thumbnail) }}" readonly>
                                            </div>
                                            @error('thumbnail')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" name="description"
                                                class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Description..."
                                                value="{{ old('description', $contest->description) }}">
                                            @error('description')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Link Youtube Embed</label>
                                            <input type="text" name="link_embed_youtube"
                                                class="form-control @error('link_embed_youtube') is-invalid @enderror"
                                                placeholder="https://youtube.com/embed/xxxx"
                                                value="{{ old('link_embed_youtube', $contest->link_embed_youtube) }}">
                                            @error('link_embed_youtube')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control text-capitalize" name="category">
                                                <option>-Select Category-</option>
                                                @foreach ($categories as $category)
                                                    @if (old($category->id, $contest->contest_category_id) == $category->id)
                                                        <option value="{{ $category->id }}" selected>
                                                            {{ $category->title }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <a href="http://" class="btn btn-primary btn-round">
                                                <i class="fas fa-plus"></i>
                                                Category
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-1">
                                            <label><span class="text-danger"></span>Content</label>
                                            <br>
                                            @error('content')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            <textarea name="content" id="input_contest_content" class="form-control" rows="20">{{ old('content', $contest->content) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label><span class="text-danger"></span>Tags</label>
                                            <div class="select2-input select2-primary">
                                                <select id="multiple" name="tag[]" class="form-control"
                                                    multiple="multiple">
                                                    @if (old('tag', $contest->tags))
                                                        @foreach (old('tag', $contest->tags) as $tag)
                                                            <option value="{{ $tag->id }}" selected>
                                                                {{ $tag->title }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <br>
                                            @error('tag')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group my-2 float-right">
                                            <button type="submit" class="btn btn-primary btn-round">
                                                <i class="fas fa-sync"></i>
                                                Update
                                            </button>
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
        // Event : Input thumbnile
        $('#button_contest_thumbnail').filemanager('image');

        // Texteditor Content (TinyMCE5)
        $('#input_contest_content').tinymce({
            relative_urls: false,
            language: "en",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            toolbar1: "fullscreen preview",
            toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            file_picker_callback: function(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                let cmsURL = "{{ route('unisharp.lfm.show') }}" + '?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });
    </script>

    <script>
        var flash = $('#flash').data('flash');
        if (flash) {
            swal("error", "{{ session('fails') }}", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
        }
    </script>

    <script>
        $('#multiple').select2({
            theme: 'bootstrap',
            language: "",
            allowClear: true,
            ajax: {
                url: "{{ route('contest.tags.select') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    </script>
@endpush
