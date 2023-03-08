@extends('home.layouts.app')

@section('content')
    <!-- Page section -->
    <section class="page-section spad contact-page">
        <div class="container">
            @if (session('success'))
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                            <h5> Terimakasih {{ session('success') }}, kami akan segera menganggapi pesan mu.</h5>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="comment-title">Contact us</h4>
                    <p>{{ $contact->description }}</p>
                    <div class="row">
                        <div class="col-md-9">
                            <ul class="contact-info-list">
                                <li>
                                    <div class="cf-left">Address</div>
                                    <div class="cf-right">{{ $contact->address }}</div>
                                </li>
                                <li>
                                    <div class="cf-left">Phone</div>
                                    <div class="cf-right">{{ $contact->phone }}</div>
                                </li>
                                <li>
                                    <div class="cf-left">E-mail</div>
                                    <div class="cf-right">{{ $contact->email }}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="{{ $sosmed->instagram }}"><i class="fa fa-instagram"></i></a>
                        <a href="{{ $sosmed->facebook }}"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $sosmed->twitter }}"><i class="fa fa-twitter"></i></a>
                        <a href="{{ $sosmed->linkedin }}"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact-form-warp">
                        <h4 class="comment-title">Leave a Reply</h4>
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="mb-4">
                                <span class="text-danger">Messages failed send</span>
                            </div>
                        @endif
                        <form class="comment-form" action="{{ route('create.message') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="name" placeholder="Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message" name="message" required></textarea>
                                    <div class="my-2 mb-4">
                                        {{-- error captcha --}}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                        {{-- /error captcha --}}
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}

                                    </div>
                                    <div class="my-4">
                                        <button class="site-btn btn-sm">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page section end -->
@endsection
