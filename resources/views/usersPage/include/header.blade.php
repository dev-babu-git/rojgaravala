<!-- Site wrapper -->
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
        <!-- Left navbar: toggle sidebar -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block ms-2">
                <span class="fw-bold">Dashboard</span>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto align-items-center">
            <!-- Fullscreen -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link p-0 ms-3" data-toggle="dropdown" href="#">
                    <img src="{{ asset('admin/img/avatar5.png') }}" class='img-circle elevation-2' width="40" height="40" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3 shadow-sm">
                    <h5 class="mb-1 fw-bold">{{ Auth::user()->name ?? '' }}</h5>
                    <small class="text-muted mb-2 d-block">{{ Auth::user()->email ?? '' }}</small>
                    <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item" id="profileSettingsModal">
                        <i class="fas fa-cog me-2"></i> Profile
                    </a>

                    
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-key me-2"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('users.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('users.dashboard') }}" class="brand-link">
            <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text fw-bold">Student Portal</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('users.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('users.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- My Tests -->
                    <li class="nav-item">
                        <a href="{{ route('student.tests.index') }}" 
                           class="nav-link {{ request()->routeIs('student.tests.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>My Tests</p>
                        </a>
                    </li>

                    <!-- Test Results -->
                    <li class="nav-item">
                        <a href="{{ route('student.tests.index') ?? '#' }}" 
                           class="nav-link {{ request()->routeIs('student.results.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Test Results</p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

   
<!-- /.wrapper -->
