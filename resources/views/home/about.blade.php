@extends('home.layouts.app')

@section('content')

<!-- inner-hero start -->
<section class="inner-hero bg_img" data-background="assets/images/bg/inner-hero.jpg">
    <div class="shape position-absolute"><img src="assets/images/elements/inner-hero/shape.png" alt="image" ></div>

    <div class="el-1 position-absolute"><img src="assets/images/elements/inner-hero/el-1.png" alt="image"></div>
    <div class="el-2 position-absolute"><img src="assets/images/elements/inner-hero/el-2.png" alt="image"></div>
    <div class="el-3 position-absolute"><img src="assets/images/elements/inner-hero/el-3.png" alt="image"></div>
    <div class="el-4 position-absolute"><img src="assets/images/elements/inner-hero/el-4.png" alt="image"></div>
    <div class="el-5 position-absolute"><img src="assets/images/elements/inner-hero/el-5.png" alt="image"></div>
    <div class="el-6 position-absolute"><img src="assets/images/elements/inner-hero/el-6.png" alt="image"></div>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2 class="page-title">About Us</h2>
          <ul class="page-list">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Pages</li>
            <li>About Us</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- inner-hero end -->

  <!-- about us section start -->
  <section id="about" class="bold-bottom--border pt-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-header text-center has--bg mb-0">
                <div class="header-image"><img src="assets/images/elements/header-el-3.png" alt="image"></div>
                <h2 class="section-title">About Us</h2>
            </div>
            <div>
                {!! $page->content !!}
            </div>
        </div>
      </div><!-- row end -->
      <div class="row">
        <div class="col-lg-12">
          <div class="about-thumb text-center">
            <img src="assets/images/elements/about-illustration.png" alt="about-image">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about us section end -->

  <!-- counter section start -->
  {{-- <div class="mt-minus-80">
    <div class="container">
      <div class="row mb-none-30 justify-content-center mt-40">
        <div class="col-lg-4 col-md-6 mb-30">
          <div class="overview-card style--two">
            <div class="overview-card__icon">
              <img src="assets/images/icon/overview/1.png" alt="image">
            </div>
            <div class="overview-card__content">
              <h4 class="overview-card__number">{{ $game }}</h4>
              <p>Games</p>
            </div>
          </div><!-- overview-card end -->
        </div>
        <div class="col-lg-4 col-md-6 mb-30">
          <div class="overview-card style--two">
            <div class="overview-card__icon">
              <img src="assets/images/icon/overview/2.png" alt="image">
            </div>
            <div class="overview-card__content">
              <h4 class="overview-card__number">+398943</h4>
              <p>Blog</p>
            </div>
          </div><!-- overview-card end -->
        </div>
        <div class="col-lg-4 col-md-6 mb-30">
          <div class="overview-card style--two">
            <div class="overview-card__icon">
              <img src="assets/images/icon/overview/3.png" alt="image">
            </div>
            <div class="overview-card__content">
              <h4 class="overview-card__number">+103</h4>
              <p>champions</p>
            </div>
          </div><!-- overview-card end -->
        </div>
      </div><!-- row end -->
    </div>
  </div> --}}
  <!-- counter section end -->

  <!-- team section start -->
  {{-- <section class="pt-120 pb-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="section-header text-center has--bg">
            <div class="header-image"><img src="assets/images/elements/header-el.png" alt="image"></div>
            <h2 class="section-title">Passionate Team</h2>
            <p>Though our team has grown over the years and includes a mix of talent, our leaders have been in game development for over 30 years.</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row mb-none-30 justify-content-center">
        <div class="col-lg-4 col-sm-6 mb-30">
          <div class="team-card">
            <div class="team-card__thumb">
              <img src="assets/images/team/1.png" alt="image">
              <div class="obj"><img src="assets/images/elements/team-obj.png" alt="image"></div>
            </div>
            <div class="team-card__content">
              <h3 class="name">Nicolas Hopkins</h3>
              <span class="designation">CEO</span>
            </div>
          </div><!-- team-card end -->
        </div>
        <div class="col-lg-4 col-sm-6 mb-30">
          <div class="team-card">
            <div class="team-card__thumb">
              <img src="assets/images/team/2.png" alt="image">
              <div class="obj"><img src="assets/images/elements/team-obj.png" alt="image"></div>
            </div>
            <div class="team-card__content">
              <h3 class="name">Orlando Mills</h3>
              <span class="designation">CTO</span>
            </div>
          </div><!-- team-card end -->
        </div>
        <div class="col-lg-4 col-sm-6 mb-30">
          <div class="team-card">
            <div class="team-card__thumb">
              <img src="assets/images/team/3.png" alt="image">
              <div class="obj"><img src="assets/images/elements/team-obj.png" alt="image"></div>
            </div>
            <div class="team-card__content">
              <h3 class="name">Israel Boone</h3>
              <span class="designation">VP, Lottery Operations</span>
            </div>
          </div><!-- team-card end -->
        </div>
      </div>
    </div>
  </section> --}}
  <!-- team section end -->

@endsection
