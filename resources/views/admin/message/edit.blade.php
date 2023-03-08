<!-- Modal Create -->
@foreach ($messageWarning as $item)
<div class="modal fade" id="modalMessage-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-pen"></i>
                    Message
                </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form action="{{ url("/admin/message/$item->id") }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <br>
                        <input type="text" class="form-control" value="{{ $item->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="title">Email</label>
                        <br>
                        <input type="text" name="email" class="form-control" value="{{ $item->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="title">Pesan</label>
                        <br>
                        <textarea rows="5" class="form-control" readonly>{{ $item->message }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">
                        Confirm
                    </button>
                </div>
            </form>
		</div>
	</div>
</div>
@endforeach
