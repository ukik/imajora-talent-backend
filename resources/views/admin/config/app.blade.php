@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">App</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('config') }}">Config</a></li>
                <li class="breadcrumb-item active">App</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md">

                <div class="form-group">
                    @if (session('success'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                {{-- content Section --}}
                <div class="row">
                    <div class="col-md-6">

                        <div class="card">
                            <form action="{{ route('app.update') }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Title</label>
                                        <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" placeholder="Title.." value="{{ old('title', $app->title) }}">
                                        @error('title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Brand Icon</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_brand_icon" data-input="input_brand_icon" class="btn btn-primary btn-border" type="button">Upload</button>
                                            </div>
                                            <input id="input_brand_icon" type="text" name="brand_icon" class="form-control @error('brand_icon') is-invalid @enderror" value="{{ old('brand_icon', $app->brand_icon) }}" readonly>
                                        </div>
                                        @error('brand_icon')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Background Recent Game</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_bg_recent_game" data-input="input_bg_recent_game" class="btn btn-primary btn-border" type="button">Upload</button>
                                            </div>
                                            <input id="input_bg_recent_game" type="text" name="bg_recent_game" class="form-control @error('bg_recent_game') is-invalid @enderror" value="{{ old('bg_recent_game', $app->bg_recent_game) }}" readonly>
                                        </div>
                                        @error('bg_recent_game')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Background Footer</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_bg_footer" data-input="input_bg_footer" class="btn btn-primary btn-border" type="button">Upload</button>
                                            </div>
                                            <input id="input_bg_footer" type="text" name="bg_footer" class="form-control @error('bg_footer') is-invalid @enderror" value="{{ old('bg_footer', $app->bg_footer) }}" readonly>
                                        </div>
                                        @error('bg_footer')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Footer Description</label>
                                        <input type="text" name="footer_description" class="form-control  @error('footer_description') is-invalid @enderror" placeholder="footer_description.." value="{{ old('footer_description', $app->footer_description) }}">
                                        @error('footer_description')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary btn-round">Save</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                {{-- /content Section --}}

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Event : Input recent game
    $('#button_bg_recent_game').filemanager('image');
    // Event : Input footer
    $('#button_bg_footer').filemanager('image');
    // Event : Input brand icon
    $('#button_brand_icon').filemanager('image');
</script>
@endpush
