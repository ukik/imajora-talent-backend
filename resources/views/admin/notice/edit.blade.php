@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Edit Notice</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/talent/' . Auth::user()->slug) }}">Talent</a></li>
                    <li class="breadcrumb-item active">Edit Notice</li>
                </ol>
            </nav>

            {{-- Alert Success --}}
            <div id="flash" data-flash="{{ session('success') }}"></div>
            {{-- /Alert Success --}}

            <div class="row my-2">
                <div class="col-lg-12">
                    <a href="{{ url('/admin/talent/' . Auth::user()->slug) }}" class="btn btn-round btn-light">
                        <i class="fas fa-undo"></i>
                        Back
                    </a>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="my-2">
                                <h1>Edit Notice</h1>
                                <hr class="my-2">
                            </div>
                            <form action="{{ url('/admin/talent/notice/' . $notice->id . '/update') }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Notice*</label>
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="3">{{ $notice->content }}</textarea>
                                    @error('content')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary btn-round">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    {{-- Tampilkan sweet alert ketika berhasil menambahkan data --}}
    <script>
        var flash = $('#flash').data('flash');
        if (flash) {
            swal("Success", "{{ session('success') }}", {
                icon: "success",
                buttons: {
                    confirm: {
                        className: 'btn btn-success'
                    }
                },
            });
        }
    </script>
@endpush
