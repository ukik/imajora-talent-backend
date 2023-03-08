@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Notice</h4>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/admin/talent/' . Auth::user()->slug) }}">Talent</a></li>
                    <li class="breadcrumb-item active">Show all</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Notice</th>
                                <th scope="col" width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notices as $notice)
                                <tr>
                                    <td>
                                        <small class="text-muted">{{ $notice->created_at->format('d, M Y') }}</small>
                                        <br>
                                        {{ $notice->content }}
                                    </td>
                                    <td>
                                        <form id="form-delete-{{ $notice->id }}"
                                            action="{{ url('/admin/talent/notice/' . $notice->id . '/delete') }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ url('admin/talent/notice/' . $notice->id) }}"
                                            class="btn btn-outline-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger"
                                            onclick="btnDelete({{ $notice->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                        {{ $notices->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
