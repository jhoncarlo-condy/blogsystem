
<header class="header">
    <!-- Main Navbar-->
    <nav class="navbar navbar-expand-lg">
      <div class="search-area">
        <div class="search-area-inner d-flex align-items-center justify-content-center">
          <div class="close-btn"><i class="icon-close"></i></div>
          <div class="row d-flex justify-content-center">
            <div class="col-md-8">
              <form action="#">
                <div class="form-group">
                  <input type="search" name="search" id="search" placeholder="What are you looking for?">
                  <button type="submit" class="submit"><i class="icon-search-1"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <!-- Navbar Brand -->
        <div class="navbar-header d-flex align-items-center justify-content-between">
          <!-- Navbar Brand --><a href="{{ route('blog.index') }}" class="navbar-brand">Blog Management System</a>
          <!-- Toggle Button-->
          <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
        </div>
        <!-- Navbar Menu -->
        <div id="navbarcollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            @yield('link')
            @guest
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link ">Login</a>
            </li>
            @endguest
            @if (Auth::user())
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->firstname }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->usertype != 3)
                    <a class="dropdown-item" href="{{ route('users.dashboard') }}">Admin Dashboard</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endif
          </ul>

        </div>
      </div>
    </nav>
  </header>

