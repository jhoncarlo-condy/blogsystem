<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">Blog Management System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item  menu-open">
            <a href="{{ route('users.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>

          </li>

          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Blog Management
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link">
                    <i class="fa fa-list-alt nav-icon" aria-hidden="true"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/top-nav-sidebar.html" class="nav-link">
                    <i class="fas fa-sticky-note    nav-icon"></i>
                  <p>Posts</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="fas fa-tasks nav-icon"></i>
                <p>
                Blog Management
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link">
                  <i class="fas fa-tag nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('post.index') }}" class="nav-link">
                  <i class="fa fa-comment nav-icon" aria-hidden="true"></i>
                  <p>Posts</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- User --}}
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>

              <p>
                Users
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
