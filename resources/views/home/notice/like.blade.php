@can('like', $model)
    <form action="{{ route('like') }}" method="POST" onsubmit="return sendLikeData(this)">
        @csrf
        <input type="hidden" name="methodname" value="POST">
        <input type="hidden" name="likeable_type" value="{{ get_class($model) }}" />
        <input type="hidden" name="notice_id" value="{{ $model->id }}" />
        <button class="btn btn-flat mb-4 btn-md" name="count">
            <i class="fa fa-thumbs-o-up"></i>
            <span>{{ count($model->likes) }}</span>
        </button>
    </form>
@endcan

@can('unlike', $model)
    <form action="{{ route('unlike') }}" method="DELETE" onsubmit="return sendLikeData(this)">
        @csrf
        <input type="hidden" name="methodname" value="DELETE">
        <input type="hidden" name="likeable_type" value="{{ get_class($model) }}" />
        <input type="hidden" name="notice_id" value="{{ $model->id }}" />
        <button class="btn btn-primary mb-4 btn-md" name="count">
            <i class="fa fa-thumbs-o-up"></i>
            <span>{{ count($model->likes) }}</span>
        </button>
    </form>
@endcan

@push('script')
    <script>
        function sendLikeData(form) {
            const method = form.methodname.value;
            $.ajax({
                url: form.action,
                type: method,
                data: {
                    _token: form._token.value,
                    likeable_type: form.likeable_type.value,
                    notice_id: form.notice_id.value,
                },
                success: function(response) {
                    form.count.classList.toggle('btn-flat');
                    form.count.classList.toggle('btn-primary');
                    form.count.class = "btn btn-primary mb-4 btn-md";
                    form.count.innerHTML = `<i class="fa fa-thumbs-o-up"></i>
                    <span>
                        ${response.likes}
                    </span>`;
                    form.methodname.value = method === 'POST' ? 'DELETE' : 'POST';
                }
            });
            return false;
        }
    </script>
@endpush
