@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Social Media</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('config') }}">Config</a></li>
                <li class="breadcrumb-item active">Social Media</li>
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
                                <form action="{{ route('social.media.update') }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Facebook</label>
                                        <input type="text" name="facebook" class="form-control  @error('facebook') is-invalid @enderror" placeholder="facebook.." value="{{ old('facebook', $socialMedia->facebook) }}">
                                        @error('facebook')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Instagram</label>
                                        <input type="text" name="instagram" class="form-control  @error('instagram') is-invalid @enderror" placeholder="instagram.." value="{{ old('instagram', $socialMedia->instagram) }}">
                                        @error('instagram')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Twitter</label>
                                        <input type="text" name="twitter" class="form-control  @error('twitter') is-invalid @enderror" placeholder="twitter.." value="{{ old('twitter', $socialMedia->twitter) }}">
                                        @error('twitter')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Linkedin</label>
                                        <input type="text" name="linkedin" class="form-control  @error('linkedin') is-invalid @enderror" placeholder="linkedin.." value="{{ old('linkedin', $socialMedia->linkedin) }}">
                                        @error('linkedin')
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
