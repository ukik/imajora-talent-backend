@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Create Game</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url("/admin/dashboard") }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ url("/admin/game") }}">Game</a></li>
                <li class="breadcrumb-item active">Create Game</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md">

                <form action="{{ route('game.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><span class="text-danger">*</span>Title</label>
                                        <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" placeholder="Title.." value="{{ old('title') }}">
                                        @error('title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Genre</label>
                                        <select class="form-control @error('genre') is-invalid @enderror" name="genre">
                                            <option value="">- Select Genre -</option>
                                            @foreach ($genres as $item)
                                            @if (old('genre') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->title }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('genre')
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
                                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description.." value="{{ old('description') }}">
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
                                                <button id="button_game_thumbnail" data-input="input_game_thumbnail" class="btn btn-primary btn-border" type="button">Upload</button>
                                            </div>
                                            <input id="input_game_thumbnail" type="text" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" value="{{ old('thumbnail') }}" readonly>
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
                                        <textarea name="content" id="input_game_content" class="form-control" rows="20">{{ old('content') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Trailer</label>
                                        <input type="text" name="trailer" class="form-control  @error('trailer') is-invalid @enderror" placeholder="trailer.." value="{{ old('trailer') }}">
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
                                            <label><span class="text-danger"></span>Device</label>
                                            <select id="multiple" name="device[]" class="form-control" multiple>
                                                @if (old('device'))
                                                    @foreach (old('device') as $device)
                                                        <option value="{{ $device->id }}" selected>{{ $device->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <br>
                                            @error('device')
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
                                            <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : NULL }} >{{ $value }}</option>
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
                                <button type="submit" class="btn btn-primary">Save</button>
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
    // Event : input game thumbnail
    $('#button_game_thumbnail').filemanager('image');

    // Texteditor Content (TinyMCE5)
    $('#input_game_content').tinymce({
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

    // Select2 device game
    $('#multiple').select2({
    theme: "bootstrap",
    language: "",
    allowClear: true,
    ajax: {
        url: "{{ route('devices.select') }}",
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
