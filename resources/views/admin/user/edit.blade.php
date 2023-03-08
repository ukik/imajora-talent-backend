@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Profile</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/setting') }}">Settings</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-md">
                    <form action="{{ url("/admin/profile/$user->id") }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PATCH')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-file input-file-image">
                                        @if ($user->avatar)
                                            <img class="img-upload-preview avatar-img rounded-circle" width="150"
                                                src="{{ asset('uploads/avatars/' . $user->avatar) }}" alt="preview">
                                        @else
                                            <img class="img-upload-preview avatar-img rounded-circle" width="150"
                                                src="{{ asset('/user/anonim.jpg') }}" alt="preview">
                                        @endif
                                        <input type="hidden" name="oldAvatar" value="{{ $user->avatar }}">
                                        <input type="file" class="form-control form-control-file" id="uploadImg1"
                                            name="avatar" accept="image/*">
                                        <label for="uploadImg1" class="ml-3 label-input-file btn btn-primary btn-round">
                                            <span class="btn-label">
                                                <i class="fa fa-file-image"></i>
                                            </span>
                                            Upload a Avatar
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>
                                            <i class="fas fa-sync"></i>
                                            Changes your profile
                                        </h4>
                                        <hr class="my-1">
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Full Name</label>
                                            <input type="text" name="name"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Full Name.." value="{{ old('name', $user->name) }}">
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger"></span>Email</label>
                                            <input type="text" name="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                placeholder="Email.." value="{{ old('email', $user->email) }}" disabled>
                                            @error('email')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger"></span>New Password</label>
                                            <input type="password" name="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                placeholder="New Password.." value="{{ old('password') }}">
                                            @error('password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger"></span>Role</label>
                                            <input type="text" name="role"
                                                class="form-control  @error('role') is-invalid @enderror"
                                                placeholder="Role.." value="{{ old('role', $user->role) }}" disabled>
                                            @error('role')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group float-right">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-sync"></i>
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
