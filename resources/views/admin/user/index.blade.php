@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">User Management</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User</li>
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

                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ url('/admin/user') }}">
                                <div class="form-group">
                                    <div class="input-icon">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search user..." value="{{ $search }}">
                                        <span class="input-icon-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <a href="{{ url('/admin/user/create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    User
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                @if ($user->role !== 'admin')
                                                    <form action="{{ url("/admin/user/$user->id") }}" method="post">
                                                        @csrf @method('DELETE')
                                                        <a href="{{ url("/admin/user/$user->email/edit") }}"
                                                            class="btn btn-primary btn-round">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-danger btn-round"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
