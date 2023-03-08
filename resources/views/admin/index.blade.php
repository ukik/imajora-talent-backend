@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
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

                {{-- Message Section --}}
                @if (Auth::user()->role == 'admin')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" id="pesan">
                                <div class="card-body">
                                    <h4>
                                        <i class="fa fa-envelope"></i>
                                        Pesan Terbaru <span class="badge badge-warning mx-2">{{ $messageWarning->count() }}</span>
                                        <a href="{{ route('message') }}" class="text-primary float-right">Tampilkan seluruh pesan</a>
                                    </h4>
                                    <table class="table table-hover">
                                        <tbody>
                                            @foreach ($messageWarning as $warning)
                                                <tr>
                                                    <td><a href="{{ url('/admin/genre') }}">{{ $warning->email }}</a></td>
                                                    <td><span class="badge badge-warning">{{ $warning->status }}</span></td>
                                                    <td width="10%">
                                                        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalMessage-{{ $warning->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $messageWarning->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- /Message Section --}}

                <div class="row">
                    @if (Auth::user()->role == 'admin')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>
                                        <i class="fab fa-blogger-b"></i>
                                        Blog Informations
                                    </h4>
                                    <hr class="my-1">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ url('/admin/category') }}">Categories</a></td>
                                                <td>{{ $categories }}</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('/admin/tag') }}">Tags</a></td>
                                                <td>{{ $tags }}</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('/admin/post') }}">Posts</a></td>
                                                <td>{{ $posts }}</td>
                                            </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>
                                        <i class="fas fa-gamepad"></i>
                                        Game Informations
                                    </h4>
                                    <hr class="my-1">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ url('/admin/genre') }}">Genres</a></td>
                                                <td>{{ $genres }}</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('/admin/game') }}">Games</a></td>
                                                <td>{{ $games }}</td>
                                            </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                    <i class="fas fa-medal"></i>
                                    Your Contribution
                                    </h4>
                                </div>
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr class="text-muted">
                                                <td><a href="{{ url('/admin/post') }}" class="text-dark"><i class="far fa-newspaper"></i> Posts</a></td>
                                                <td>{{ $contributionPost }}</td>
                                            </tr>
                                            <tr class="text-muted">
                                                <td><a href="{{ url('/admin/game') }}" class="text-dark"><i class="fas fa-gamepad"></i> Game</a></td>
                                                <td>{{ $contributionGame }}</td>
                                            </tr>
                                    </table>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@include('admin.message.edit')

@endsection
