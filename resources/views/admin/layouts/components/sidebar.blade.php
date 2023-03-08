<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    <a data-toggle="collapse" href="#collapseProfile" aria-expanded="true">
                        <span class="text-capitalize">
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->role }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseProfile">
                        <ul class="nav">
                            <li>
                                <a href="{{ url('/admin/setting') }}">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="link-collapse">Logout</span>
                                </a>
                                <form action="{{ route('logout') }}" id="logout-form" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-section">
                    <h4 class="text-section">MENU NAVIGATION</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/talent/' . Auth::user()->slug) }}">
                        <i class="fas fa-star"></i>
                        <p>Talent</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('config') }}">
                            <i class="fas fa-cogs"></i>
                            <p>Configs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pages') }}">
                            <i class="fas fa-book-open"></i>
                            <p>Pages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/user') }}">
                            <i class="fas fa-users"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif
                <li class="nav-section">
                    <h4 class="text-section">BLOG MANAGEMENT</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/category') }}">
                        <i class="far fa-clipboard"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/tag') }}">
                        <i class="fas fa-tags"></i>
                        <p>Tags</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/post') }}">
                        <i class="far fa-newspaper"></i>
                        <p>Posts</p>
                    </a>
                </li>
                <li class="nav-section">
                    <h4 class="text-section">GAME MANAGEMENT</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/genre') }}">
                        <i class="fas fa-th-large"></i>
                        <p>Genres</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/game') }}">
                        <i class="fas fa-gamepad"></i>
                        <p>Games</p>
                    </a>
                </li>
                <li class="nav-section">
                    <h4 class="text-section">CONTEST MANAGEMENT</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contest.index') }}">
                        <i class="far fa-clipboard"></i>
                        <p>Contest</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
