@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">
                <i class="fas fa-pen"></i>
                Edit Post
            </h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url("/admin/dashboard") }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ url("/admin/post") }}">Posts</a></li>
                <li class="breadcrumb-item active">Edit Post</li>
            </ol>
        </nav>
        <div class="page-category">Inner page content goes here</div>
        <div class="row">
            <div class="col-md">

                <form action="{{ url("/admin/post/$post->id") }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>Title</label>
                                        <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" placeholder="Title.." value="{{ old('title', $post->title) }}">
                                        @error('title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control @error('category') is-invalid @enderror" name="category">
                                            <option value="">- Select Category -</option>
                                            @foreach ($categories as $item)
                                            @if (old($item->id, $post->category_id) == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                                            @endif
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group mb-1">
                                        <label><span class="text-danger"></span>Description</label>
                                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description.." value="{{ old('description', $post->description) }}">
                                        @error('description')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>thumbnail</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_post_thumbnail" data-input="input_post_thumbnail" class="btn btn-primary btn-border" type="button">Upload</button>
                                            </div>
                                            <input id="input_post_thumbnail" type="text" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" value="{{ old('thumbnail',asset($post->thumbnail)) }}" readonly>
                                        </div>
                                        @error('thumbnail')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-group mb-1">
                                        <label><span class="text-danger"></span>Content</label>
                                        <br>
                                        @error('content')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        <textarea name="content" id="input_post_content" class="form-control" rows="20">{{ old('content', $post->content) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="select2-input select2-primary">
                                            <label><span class="text-danger"></span>Tags</label>
                                            <select id="multiple" name="tag[]" class="form-control" multiple>
                                                @if (old('tag', $post->tags))
                                                    @foreach (old('tag', $post->tags) as $tag)
                                                        <option value="{{ $tag->id }}" selected>{{ $tag->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('tag')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>Status</label>
                                        <select class="form-control  @error('status') is-invalid @enderror" name="status">
                                            <option value="">- Select Status -</option>
                                            @foreach ($statuses as $key => $value)
                                            <option value="{{ $key }}" {{ old('status', $post->status) == $key ? 'selected' : NULL }} >{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <a href="{{ url('/admin/post') }}" class="btn btn-warning">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>



                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Event : Input thumbnile
    $('#button_post_thumbnail').filemanager('image');

    // Texteditor Content (TinyMCE5)
    $('#input_post_content').tinymce({
    relative_urls: false,
    language: "en",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern",
    ],
    toolbar1: "fullscreen preview",
    toolbar2:
        "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
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

    // Select 2 tag post
    $('#multiple').select2({
    theme: "bootstrap",
    language: "",
    allowClear: true,
    ajax: {
        url: "{{ route('tags.select') }}",
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
