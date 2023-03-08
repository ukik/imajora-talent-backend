@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Genre</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url("/admin/dashboard") }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Genre</li>
            </ol>
        </nav>
        <div class="page-category">

        </div>

        {{-- Start --}}
        <div class="row">
            <div class="col-md">
                <form action="/admin/genre/">
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
                            <span class="input-icon-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createGenre">
                        <i class="fas fa-plus"></i>
                        Tag
                    </button>
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

        <div class="row">
            <div class="col-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" width="10%">No</th>
                            <th scope="col">Tag</th>
                            <th scope="col" width="20%">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @foreach ($genre as $item)
                        <?php $no++ ?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <form action="{{ url("/admin/genre/$item->slug") }}" method="post">
                                    @csrf @method('DELETE')
                                        <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#editGenre-{{ $item->slug }}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-round" onclick="return confirm('Apakah anda yakin ingin menghapus Genre ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="d-flex justify-content-center">
                    {{ $genre->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        {{-- End --}}




    </div>
</div>

@include('admin.genre.create')
@include('admin.genre.edit')

@endsection
