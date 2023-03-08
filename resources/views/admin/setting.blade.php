@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Setting</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Your Profile</h4>
                            <hr class="my-1">
                            <div class="row my-4">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        @if (Auth::user()->avatar)
                                            <img class="img-fluid rounded-circle" width="150"
                                                src="{{ asset('uploads/avatars/' . Auth::user()->avatar) }}" alt="preview">
                                        @else
                                            <img class="avatar-img rounded-circle" width="150"
                                                src="{{ asset('/user/anonim.jpg') }}" alt="preview">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <span class="badge badge-primary ml-4 mb-2">{{ Auth::user()->role }}</span>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>{{ Auth::user()->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ Auth::user()->email }}</td>
                                            </tr>
                                    </table>
                                    <a href="/admin/profile/{{ Auth::user()->email }}/edit" class="btn">
                                        <i class="far fa-edit"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
