@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Game</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Game</li>
                </ol>
            </nav>
            <div class="page-category">

            </div>

            {{-- Start --}}
            <div class="row">
                <div class="col-md">
                    <form action="/admin/game/">
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
                <div class="col-md">
                    <div class="form-group">
                        <a href="{{ url('/admin/game/create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Game
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
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr class="my-4">

            <div class="row justify-content-center">
                @foreach ($games as $game)
                @endforeach

                @forelse ($games as $game)
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ url("$game->thumbnail") }}" class="img-fluid shadow" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <h4>{{ $game->title }}</h4>
                                        <span class="badge">{{ $game->genre->title }}</span>
                                        @if ($game->status == 'publish')
                                            <span class="text-capitalize badge badge-success">{{ $game->status }}</span>
                                        @else
                                            <span class="text-capitalize badge badge-danger">{{ $game->status }}</span>
                                        @endif
                                        <div>
                                            {!! Str::limit($game->description, 60, '...') !!}
                                            <br>
                                            <span class="text-muted">Author : {{ $game->user->name }}</span>
                                            <br>
                                            <span class="text-muted">{{ $game->updated_at->format('d, M Y') }}</span>
                                        </div>
                                        <div class="float-right">
                                            @if ($game->user->id == Auth::user()->id || Auth::user()->role == 'admin')
                                                <form action="{{ url("/admin/game/$game->id") }}" method="post">
                                                    @csrf @method('DELETE')
                                                    <a href="{{ url("/admin/game/$game->slug/edit") }}"
                                                        class="btn btn-primary btn-round">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="submit" class="btn btn-danger btn-round"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus game ini?')">
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
                    <h1><i>Belum terdapat kontent game.</i></h1>
                @endforelse
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="d-flex justify-content-center">
                        {{ $games->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            {{-- End --}}




        </div>
    </div>
@endsection
