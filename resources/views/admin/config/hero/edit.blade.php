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
                            <form action="{{ url("/admin/config/hero/update/$hero->id") }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Title</label>
                                        <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" placeholder="Title.." value="{{ old('title', $hero->title) }}">
                                        @error('title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Description</label>
                                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" rows="5">{{ old('description', $hero->description) }}</textarea>
                                        @error('description')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_carousel_image" data-input="input_image" class="btn btn-primary btn-border" type="button">Upload</button>
                                            </div>
                                            <input id="input_image" type="text" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $hero->image) }}" readonly>
                                        </div>
                                        @error('image')
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
    $('#button_carousel_image').filemanager('image');
</script>
@endpush
