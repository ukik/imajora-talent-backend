@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Skill</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Create new skill</li>
                </ol>
            </nav>

            {{-- Alert Success --}}
            <div id="flash" data-flash="{{ session('success') }}"></div>
            {{-- /Alert Success --}}

            <div class="row my-2">
                <div class="col-lg-12">
                    <a href="{{ url('/admin/talent/' . Auth::user()->slug . '/edit') }}" class="btn btn-round btn-light">
                        <i class="fas fa-undo"></i>
                        Back
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('skill.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Skill or Talent</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" placeholder="New skill..." required>

                                    @error('title')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-round">
                                        <i class="fas fa-plus"></i>
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Skill</th>
                                        <th scope="col" width="15%">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no =1; @endphp
                                    @foreach ($skills as $skill)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $skill->title }}</td>
                                            <td>
                                                <form id="form-delete-{{ $skill->id }}"
                                                    action="{{ url("/admin/skill/$skill->id/delete") }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="btnDelete( {{ $skill->id }} )">
                                                    <i class="fas fa-pen"></i>
                                                    Delete
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
