<div class="collapse" id="showReply-{{ $comment->id }}">
    @foreach ($comment->where('parent', $comment->id)->orderBy('created_at', 'desc')->get() as $reply)
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="form-inline">
                    @if ($reply->user->avatar)
                        <img src="{{ asset('uploads/avatars/' . $reply->user->avatar) }}" class="img-fluid rounded-circle"
                            width="43px" alt="">
                    @else
                        <img src="{{ asset('/user/anonim.jpg') }}" class="img-fluid rounded-circle" width="43px"
                            alt="">
                    @endif
                    <label class="font-weight-normal ml-4">{{ $reply->name }}<small class="text-muted ml-2">June 21,
                            2020</small></label>
                </div>
                <p style="margin-left: 66px;" class="text-dark">
                    {{ $reply->message }}
                </p>
            </div>
        </div>
    @endforeach
</div>
