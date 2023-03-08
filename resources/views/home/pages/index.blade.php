@extends('home.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-4">
                <h1>{{ $page->title }}</h1>
            </div>
            <div class="col-lg-12">
                <p>{!! $page->content !!}</p>
            </div>
        </div>
    </div>
@endsection
