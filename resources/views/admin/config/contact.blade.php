@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Contact</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('config') }}">Config</a></li>
                <li class="breadcrumb-item active">Contact</li>
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
                            <div class="card-body">
                                <form action="{{ route('contact.update') }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Description</label>
                                        <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" placeholder="description.." value="{{ old('description', $contact->description) }}">
                                        @error('description')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Address</label>
                                        <input type="text" name="address" class="form-control  @error('address') is-invalid @enderror" placeholder="address.." value="{{ old('address', $contact->address) }}">
                                        @error('address')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Email</label>
                                        <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="email.." value="{{ old('email', $contact->email) }}">
                                        @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Phone</label>
                                        <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="phone.." value="{{ old('phone', $contact->phone) }}">
                                        @error('phone')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
                {{-- /content Section --}}

            </div>
        </div>
    </div>
</div>

@endsection
