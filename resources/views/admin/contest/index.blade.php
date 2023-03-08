@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Contest</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Contest</li>
                </ol>
            </nav>

            {{-- Alert Success --}}
            <div id="flash" data-flash="{{ session('success') }}"></div>
            {{-- /Alert Success --}}

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('contest.create') }}" class="btn btn-primary btn-round">
                        <i class="fas fa-plus"></i>
                        Contest
                    </a>
                </div>
                <div class="col-md-12 my-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Publish Date</th>
                                                <th scope="col">Contest Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Thumbnail</th>
                                                <th scope="col">Author</th>
                                                <th scope="col" width="15%">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach ($contests as $contest)
                                                <?php $no++; ?>
                                                <tr>
                                                    <td>{{ $no }}</td>
                                                    <td>{{ $contest->created_at->format('d-M-Y') }}</td>
                                                    <td>{{ $contest->title }}</td>
                                                    <td>{{ $contest->categories->title }}</td>
                                                    <td>
                                                        <img src="{{ $contest->thumbnail }}" class="img-fluid"
                                                            width="100px" alt="">
                                                    </td>
                                                    <td>{{ $contest->users->name }}</td>
                                                    <td>
                                                        <form id="form-delete-{{ $contest->id }}"
                                                            action="{{ route('contest.delete', $contest->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a href="{{ route('contest.edit', $contest->slug) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="btnDelete({{ $contest->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        {{ $contests->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
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
