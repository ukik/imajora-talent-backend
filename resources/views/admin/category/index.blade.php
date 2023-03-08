@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Category</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ url("/admin/dashboard") }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </nav>
        <div class="page-category">

        </div>

        {{-- Start --}}
        <div class="row">
            <div class="col-md">
                <form action="/admin/category/">
                    <div class="form-group">
                        <div class="input-icon">
                            <input type="text" name="search" class="form-control" placeholder="Search for..." value="{{ $search }}">
                            <span class="input-icon-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategory">
                        <i class="fas fa-plus"></i>
                        Category
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="10%">No</th>
                            <th scope="col">Category</th>
                            <th scope="col" width="20%">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @foreach ($categories as $item)
                        <?php $no++ ?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <form action="{{ url("/admin/category/$item->slug") }}" method="post">
                                    @csrf @method('DELETE')
                                        {{-- <a href="{{ url("/admin/category/$item->slug/edit") }}" class="btn btn-primary btn-round" data-toggle="modal" data-target="#editCategory-{{ $item->slug }}">
                                            <i class="fas fa-pen"></i>
                                        </a> --}}
                                        <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#editCategory-{{ $item->slug }}">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-round" onclick="return confirm('Apakah anda yakin ingin menghapus category ini?')">
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
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        {{-- End --}}




    </div>
</div>

@include('admin.category.create')
@include('admin.category.edit')

@endsection
