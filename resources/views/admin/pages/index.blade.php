@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Page</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pages</li>
                </ol>
            </nav>
            <div class="page-category">

            </div>

            {{-- Start --}}
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <a href="{{ route('pages.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Page
                        </a>
                    </div>
                </div>
            </div>

            {{-- Alert Success --}}
            <div id="flash" data-flash="{{ session('success') }}"></div>
            {{-- /Alert Success --}}
            {{-- Alert error --}}
            <div id="flashError" data-flash="{{ session('error') }}"></div>
            {{-- /Alert error --}}

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Page</th>
                                <th scope="col" width="35%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td><strong>{{ $page->title }}</strong></td>
                                    <td>
                                        <form id="form-delete-{{ $page->id }}"
                                            action="{{ route('pages.delete', $page) }}" method="post">
                                            @csrf @method('DELETE')
                                            <a href="{{ url("/admin/pages/$page->slug/edit") }}"
                                                class="btn btn-primary btn-round">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-round"
                                                onclick="btnDelete({{ $page->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="d-flex justify-content-center">
                        {{-- {{ $pages->links('pagination::bootstrap-4') }} --}}
                    </div>
                </div>
            </div>
            {{-- End --}}




        </div>
    </div>
@endsection

@push('scripts')
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
    <script>
        var flash = $('#flashError').data('flash');
        if (flash) {
            swal("Error", "{{ session('error') }}", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
        }
    </script>
    {{-- button deleted sweet alert --}}
    <script>
        function btnDelete(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Yes, delete it!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $('#form-delete-' + id).submit();
                } else {
                    swal.close();
                }
            });
        }
    </script>
@endpush
