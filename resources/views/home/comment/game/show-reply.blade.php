<div class="collapse" id="showReply-{{ $comment->id }}">
    @foreach ($comment->where('parent', $comment->id)->orderBy('created_at', 'desc')->get() as $reply)
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="form-inline">
                    @if ($reply->user_id)
                        <img src="{{ asset('uploads/avatars/' . $reply->user->avatar) }}" class="img-fluid rounded-circle"
                            width="43px" alt="">
                    @else
                        <img src="{{ asset('/user/anonim.jpg') }}" class="img-fluid rounded-circle" width="43px"
                            alt="">
                    @endif
                    <label class="font-weight-normal ml-4">{{ $reply->name }}<small
                            class="text-muted ml-2">{{ $reply->created_at->format('d, M Y') }}</small></label>
                </div>
                <p style="margin-left: 66px;" class="text-dark">
                    {{ $reply->message }}
                </p>
            </div>
        </div>
    @endforeach
</div>
