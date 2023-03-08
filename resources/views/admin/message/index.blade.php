@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
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

                {{-- Message Section --}}
                @if (Auth::user()->role == 'admin')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" id="pesan">
                                <div class="card-body">
                                    <h4>
                                        <i class="fa fa-envelope"></i>
                                        Pesan Terbaru
                                        <a href="{{ route('message') }}" class="text-primary float-right">Tampilkan seluruh pesan</a>
                                    </h4>
                                    <table class="table table-hover">
                                        <tbody>
                                            @foreach ($messageWarning as $item)
                                                <tr>
                                                    <td><a href="{{ url('/admin/genre') }}">{{ $item->email }}</a></td>
                                                    <td>
                                                        @if ($item->status == 'confirm')
                                                            <span class="badge badge-success">{{ $item->status }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ $item->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td width="10%">
                                                        <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalMessage-{{ $item->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $messageWarning->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- /Message Section --}}

            </div>
        </div>
    </div>
</div>

@include('admin.message.edit')

@endsection
