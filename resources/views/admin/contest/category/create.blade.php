@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">New Category</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('contest.index') }}">Contest</a></li>
                    <li class="breadcrumb-item active">New Category</li>
                </ol>
            </nav>

             {{-- Alert Success --}}
             <div id="flash" data-flash="{{ session('success') }}"></div>
             {{-- /Alert Success --}}

            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('contest.create') }}" class="btn btn-outline-primary btn-round">
                        <i class="fas fa-undo"></i>
                        Back
                    </a>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-lg-6 mr-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=0 ?>
                                    @foreach ($categories as $category)
                                    <?php $no++ ?>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $category->title }}</td>
                                            <td>
                                                <form id="form-delete-{{ $category->id }}"
                                                    action="{{ route('contest.category.delete', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-danger" type="button" onclick="btnDelete( {{ $category->id }} )">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $categories->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <form action="{{ route('contest.category.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Category..." value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group float-right">
                                    <button class="btn btn-primary btn-round" type="submit">
                                        <i class="fas fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
