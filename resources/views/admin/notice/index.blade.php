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
                        action="{{ url('/admin/talent/notice/' . $notice->id . '/delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="{{ url('admin/talent/notice/' . $notice->id) }}" class="btn btn-outline-warning">
                        <i class="fas fa-pen"></i>
                    </a>
                    <button type="button" class="btn btn-outline-danger" onclick="btnDelete({{ $notice->id }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


@push('scripts')
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
