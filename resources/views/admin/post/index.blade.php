@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Post</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Posts</li>
                </ol>
            </nav>
            <div class="page-category">

            </div>

            {{-- Start --}}
            <div class="row">
                <div class="col-md">
                    <form action="/admin/post">
                        <div class="form-group">
                            <div class="input-icon">
                                <input type="text" name="search" class="form-control" placeholder="Search for..."
                                    value="{{ $search }}">
                                <span class="input-icon-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form action="{{ url('/admin/post') }}">
                        <div class="form-group">
                            <div class="input-group">
                                <select class="form-control" name="status">
                                    <option value="">-- All Status --</option>
                                    @foreach ($statuses as $key => $value)
                                        <option value="{{ $key }}" class="text-capitalize"
                                            {{ old('status', $status) == $key ? 'selected' : null }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-prepend ml-2">
                                    <button class="btn btn-primary btn-border" type="submit">
                                        <i class="fa fa-search"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="{{ url('/admin/post/create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Post
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        @if (session('success'))
                            <div class="alert alert-primary" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        @if (session('error'))
                            <div class="alert alert-warning" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @forelse ($posts as $post)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ url("$post->thumbnail") }}" class="img-fluid shadow" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h4>{{ $post->title }}</h4>
                                        <span class="badge">{{ $post->category->title }}</span>

                                        @if ($post->status == 'publish')
                                            <span class="text-capitalize badge badge-success">{{ $post->status }}</span>
                                        @else
                                            <span class="text-capitalize badge badge-danger">{{ $post->status }}</span>
                                        @endif
                                        <div>
                                            {!! Str::limit($post->description, 60, '...') !!}
                                            <br>
                                            <span class="text-muted">Author : {{ $post->user->name }}</span>
                                            <br>
                                            <span class="text-muted">{{ $post->updated_at->format('d, M Y') }}</span>
                                        </div>
                                        <div class="float-right">
                                            @if ($post->user->id == Auth::user()->id || Auth::user()->role == 'admin')
                                                <form action="{{ url("/admin/post/$post->id") }}" method="post">
                                                    @csrf @method('DELETE')
                                                    <a href="{{ url("/admin/post/$post->id/edit") }}"
                                                        class="btn btn-primary btn-round">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger btn-round"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus post ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <h1><i>Belum terdapat postingan.</i></h1>
                @endforelse
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="d-flex justify-content-center">
                        {{ $posts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            {{-- End --}}




        </div>
    </div>

    {{-- @include('admin.tag.create')
@include('admin.tag.edit') --}}
@endsection
