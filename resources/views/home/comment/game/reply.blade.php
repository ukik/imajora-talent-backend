<div class="collapse" id="reply-{{ $comment->id }}">
    @if (Auth::check())
        {{-- Jika user login --}}
        <form action="{{ url("/game/$game->id/reply") }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-inline">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset('uploads/avatars/' . Auth::user()->avatar) }}"
                                            class="img-fluid rounded-circle" width="43px" alt="">
                                    @else
                                        <img src="{{ asset('/user/anonim.jpg') }}" class="img-fluid rounded-circle"
                                            width="43px" alt="">
                                    @endif
                                    <label class="font-weight-normal ml-4">{{ Auth::user()->name }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" name="parent"
                                    value="{{ $comment->id }}" required hidden>
                                <input type="text" class="form-control mt-2" name="message" placeholder="Comment..."
                                    required>
                                <div class="mt-4">
                                    {{-- error captcha --}}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                    {{-- /error captcha --}}
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}

                                </div>
                                <button type="submit" class="btn btn-warning float-right mt-2">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- /Jika user login --}}
    @else
        {{-- Jika user tidak login --}}
        <form action="{{ url("/game/$game->id/reply") }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2" name="name"
                                            placeholder="Full Name..." required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2" name="email"
                                            placeholder="Email..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mt-2" name="parent"
                                    value="{{ $comment->id }}" required hidden>
                                <input type="text" class="form-control mt-2" name="message" placeholder="Comment..."
                                    required>
                                <div class="mt-4">
                                    {{-- error captcha --}}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                    {{-- /error captcha --}}
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}

                                </div>
                                <button type="submit" class="btn btn-warning float-right mt-2">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- /Jika user tidak login --}}
    @endif
</div>
