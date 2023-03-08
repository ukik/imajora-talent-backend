<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        @if ($user->avatar)
                            <img class="img-fluid rounded-circle" width="200px" height="200px"
                                src="{{ asset('uploads/avatars/' . $user->avatar) }}" alt="preview">
                        @else
                            <img class="img-fluid rounded-circle" width="200px" height="200px"
                                src="{{ asset('/user/anonim.jpg') }}" alt="preview">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h1 class="text-capitalize">{{ $user->name }}</h1>

                        {{-- list skill --}}
                        <div class="my-2">
                            @foreach (Auth::user()->skills as $skill)
                                <span class="badge badge-count">{{ $skill->title }}</span>
                            @endforeach
                        </div>

                        {{-- Description --}}
                        <div class="my-2">
                            {{ Auth::user()->description }}
                        </div>

                        {{-- Action / Opsi Button (Update Profile) --}}
                        <div class="my-2">
                            <a href="{{ url('/admin/talent/' . Auth::user()->slug . '/edit') }}"
                                class="btn btn-primary btn-round btn-border">Edit</a>
                        </div>

                    </div>
                </div>

                {{-- Divider --}}
                <hr class="mt-4">

                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ url('admin/talent/gallery/create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus"></i>
                            Gallery
                        </a>
                        <a href="{{ route('notice.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Notice
                        </a>
                    </div>
                </div>

                {{-- Notice --}}
                <div class="row py-4">
                    <div class="col-md-12">
                        <h1>
                            Notice
                            <span class="badge badge-count">{{ $noticeCount }}</span>
                        </h1>
                    </div>
                    <div class="col-md-12">
                        @include('admin.notice.index')
                    </div>
                </div>
                {{-- Show All Notice --}}
                <div class="row">
                    <div class="col-md">
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/admin/talent/notice/show/' . Auth::user()->slug) }}"
                                class="btn btn-link">show all</a>
                        </div>
                    </div>
                </div>

                {{-- Gallery --}}
                <div class="row py-4">
                    <div class="col-md-12">
                        <h1>
                            Gallery
                            <span class="badge badge-count">{{ $galleryCount }}</span>
                        </h1>
                    </div>
                    <div class="col-md-12">
                        @include('admin.gallery.index')
                    </div>
                </div>
                {{-- Show All Gallery --}}
                <div class="row">
                    <div class="col-md">
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/admin/talent/gallery/show/' . Auth::user()->slug) }}"
                                class="btn btn-link">show all</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
