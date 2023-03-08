<div class="modal fade" id="modalNewAlbum" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New Album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('new.album') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Album</label>
                        <input type="text" class="form-control" name="name" placeholder="Album name.." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        New
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
