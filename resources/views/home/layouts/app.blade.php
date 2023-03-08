<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Game Studio {{ isset($subTitle) ? '| ' . $subTitle : '' }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="Game Warrior Template">
    <meta name="keywords" content="warrior, game, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="shortcut icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />

    {{-- Sharethis Plugin --}}
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=632c6884329bd50012d9aac7&product=sticky-share-buttons"
        async="async"></script>


    <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <![endif]-->
    @stack('head')

    {{-- OneSignal - Test --}}
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "dd9141f0-2a58-4172-95de-42803f64999b",
            });
        });
    </script>
    {{--
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> --}}

</head>

<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Header section -->
    {{-- <header class="header-section">
        <div class="container">
            <!-- logo -->
            <a class="site-logo" href="{{ url('/') }}">
                <img src="{{ asset($app->brand_icon) }}" alt="">
            </a>
            <div class="user-panel">
                @guest
                    <a href="{{ url('/login') }}">Login / Register</a>
                @else
                    <a href="{{ url('/admin/dashboard') }}">My Dashboard</a>
                @endguest
            </div>
            <!-- responsive -->
            <div class="nav-switch">
                <i class="fa fa-bars"></i>
            </div>
            <!-- site menu -->
            <nav class="main-menu">
                <ul class="navbar navbar-expand-lg">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/game') }}">Games</a></li>
                    <li><a href="{{ url('blog') }}">Blog</a></li>
                    <li><a href="{{ url('/talent') }}">Talent</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Pages
                        </a>
                        <div class="dropdown-menu">
                            @foreach ($pages as $page)
                                <a class="dropdown-item" href="#">{{ $page->title }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header> --}}

    <section style="background-color: black; padding: 18px;">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset($app->brand_icon) }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item ml-4 active">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item ml-4">
                            <a class="nav-link" href="{{ url('/game') }}">Games</a>
                        </li>
                        <li class="nav-item ml-4">
                            <a class="nav-link" href="{{ url('/blog') }}">Blog</a>
                        </li>
                        <li class="nav-item ml-4">
                            <a class="nav-link" href="{{ url('/talent') }}">Talent</a>
                        </li>
                        <li class="nav-item ml-4">
                            <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                        </li>
                        <li class="nav-item ml-4 dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pages
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach ($pages as $page)
                                    <a class="dropdown-item"
                                        href="{{ route('pages.detail', $page->slug) }}">{{ $page->title }}</a>
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item ml-4">
                            <a class="nav-link" href="{{ url('/contest') }}">Contest</a>
                        </li>
                    </ul>
                </div>
                <div class="user-panel">
                    @guest
                        <a href="{{ url('/login') }}">Login / Register</a>
                    @else
                        <a href="{{ url('/admin/dashboard') }}">My Dashboard</a>
                    @endguest
                </div>
            </nav>
        </div>
    </section>
    <!-- Header section end -->


    <!-- Hero section -->
    @yield('hero')
    <!-- Hero section end -->


    <!-- Latest news section -->
    <div class="latest-news-section">
        <div class="ln-title">Latest News</div>
        <div class="news-ticker">
            <div class="news-ticker-contant">
                @forelse ($latestNews as $item)
                    <div class="nt-item"><span class="new">{{ $item->category->title }}</span>{{ $item->title }}
                    </div>
                @empty
                    <div class="nt-item"><span class="new">Belum terdapat postingan</span></div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Latest news section end -->



    @yield('content')


    <!-- Footer top section -->
    <section class="footer-top-section">
        <div class="container">
            <div class="footer-top-bg">
                <img src="{{ asset($app->bg_footer) }}" alt="">
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-logo text-white">
                        <img src="{{ asset($app->brand_icon) }}" alt="">
                        <p>{{ $app->footer_description }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget mb-5 mb-md-0">
                        <h4 class="fw-title">Latest Posts</h4>
                        <div class="latest-blog">
                            @forelse ($appsNews as $posts)
                                <div class="lb-item">
                                    @if ($posts->thumbnail)
                                        <div class="lb-thumb set-bg" data-setbg="{{ asset($posts->thumbnail) }}">
                                        </div>
                                    @else
                                        <div class="lb-thumb set-bg"
                                            data-setbg="{{ asset('dummy/news-dummy.png') }}">
                                        </div>
                                    @endif
                                    <div class="lb-content">
                                        <div class="lb-date">{{ $posts->created_at->format('d, M Y') }}</div>
                                        <p><a class="text-white"
                                                href="{{ url("/blog/$posts->slug") }}">{{ $posts->title }}</a></p>
                                        <span class="lb-author text-capitalize">By {{ $posts->user->name }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="lb-item">
                                    <p>Belum terdapat postingan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget mb-5 mb-md-0">
                        <h4 class="fw-title">Latest Games</h4>
                        <div class="latest-blog">
                            @forelse ($appsGames as $games)
                                <div class="lb-item">
                                    @if ($games->thumbnail)
                                        <div class="lb-thumb set-bg" data-setbg="{{ asset($games->thumbnail) }}">
                                        </div>
                                    @else
                                        <div class="lb-thumb set-bg"
                                            data-setbg="{{ asset('dummy/game-dummy.png') }}">
                                        </div>
                                    @endif
                                    <div class="lb-content">
                                        <div class="lb-date">{{ $games->created_at->format('d, M Y') }}</div>
                                        <p><a class="text-white"
                                                href="{{ url("/game/$games->slug#details") }}">{{ $games->title }}</a>
                                        </p>
                                        <span class="lb-author text-capitalize">By {{ $games->user->name }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="lb-item">
                                    <p>Belum terdapat games</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer top section end -->


    <!-- Footer section -->
    <footer class="footer-section">
        <div class="container">
            <ul class="footer-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/game') }}">Games</a></li>
                <li><a href="{{ url('/blog') }}">Blog</a></li>
                <li><a href="{{ url('/talent') }}">Talent</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>
            {{-- <p class="copyright">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                    aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            </p> --}}
        </div>
    </footer>
    <!-- Footer section end -->


    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('script')
</body>

</html>
