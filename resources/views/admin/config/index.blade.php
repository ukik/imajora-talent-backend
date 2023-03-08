@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Configs</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Config</li>
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

                {{-- configs Section --}}
                @if (Auth::user()->role == 'admin')
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Apps</td>
                                        <td class="col-lg-2">
                                            <a href="{{ url('admin/config/app') }}" class="btn btn-primary btn-round">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Social Media</td>
                                        <td class="col-lg-2">
                                            <a href="{{ url('admin/config/social-media') }}" class="btn btn-primary btn-round">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contact</td>
                                        <td class="col-lg-2">
                                            <a href="{{ url('admin/config/contact') }}" class="btn btn-primary btn-round">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b><h2>Hero Section</h2></b></td>
                                    </tr>
                                    @foreach ($carousel as $carousel)
                                    <tr>
                                        <td>{{ $carousel->title }}</td>
                                        <td class="col-lg-2">
                                            <a href="{{ url("/admin/config/hero/$carousel->id") }}" class="btn btn-primary btn-round">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                {{-- /configs Section --}}

            </div>
        </div>
    </div>
</div>

@endsection


                            {{-- @foreach ($carousel as $carousel)
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label><span class="text-danger"></span>Carousel {{ $carousel->id }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="button_carousel_one" data-input="input_carousel_one" class="btn btn-primary btn-border" type="button">Upload</button>
                                            </div>
                                            <input id="input_carousel_one" type="text" name="carousel_one" class="form-control @error('carousel_one') is-invalid @enderror" value="{{ old('carousel_one', $app->carousel_one) }}" readonly>
                                        </div>
                                        @error('carousel_one')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @endforeach --}}
