<!-- Modal Create -->
@foreach ($categories as $item)
<div class="modal fade" id="editCategory-{{ $item->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-pen"></i>
                    Edit Category
                </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <form action="{{ url("/admin/category/$item->slug") }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Category</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Category.." value="{{ old('title', $item->title) }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sync"></i>
                        Update
                    </button>
                </div>
            </form>
		</div>
	</div>
</div>
@endforeach
