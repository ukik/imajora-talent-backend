@extends('home.layouts.app')

@section('content')
    <section class="page-section recent-game-page spad">
        <div class="container">
            <div class="row py-4 align-items-center">
                <div class="col-lg-3">
                    @if ($profile->avatar)
                        <img class="img-fluid rounded-circle" width="200px" height="200px"
                            src="{{ asset('uploads/avatars/' . $profile->avatar) }}" alt="preview">
                    @else
                        <img class="img-fluid rounded-circle" width="200px" height="200px"
                            src="{{ asset('/user/anonim.jpg') }}" alt="preview">
                    @endif
                </div>
                <div class="col-lg-8">
                    <a href="{{ url("/talent/$profile->slug") }}" class="text-dark">
                        <h3>{{ $profile->name }}</h3>
                    </a>
                    @foreach ($profile->skills as $skill)
                        <span class="badge badge-pill badge-info">
                            {{ $skill->title }}
                        </span>
                    @endforeach
                    <p>
                        {{ $profile->description }}
                    </p>
                </div>
            </div>


            {{-- Navigasi tab --}}
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Notice
                    </button>
                    <button class="nav-link" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button"
                        role="tab" aria-controls="nav-home" aria-selected="true">Gallery
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
                    @include('home.notice.index')
                </div>
                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div id="gallery_data">
                        @include('home.gallery.index')
                    </div>
                </div>
            </div>

        </div>
    </section>

    @push('script')
        {{-- This write your code --}}
    @endpush
@endsection
