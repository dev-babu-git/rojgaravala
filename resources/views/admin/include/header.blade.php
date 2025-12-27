<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Right navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <div class="navbar-nav pl-2">
            <ol class="breadcrumb p-0 m-0 bg-white">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                    <img src="{{ asset('admin/img/avatar5.png')}}" class='img-circle elevation-2' width="40" height="40" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                    <h4 class="h4 mb-0"><strong> {{ Auth::user()->name ?? ''}}</strong></h4>
                    <div class="mb-3">{{ Auth::user()->email ?? ''}}</div>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-cog mr-2"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-lock mr-2"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('admin.logout')}}" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-info elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('admin.dashboard')}}" class="brand-link">
            <img src="{{ asset('admin/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}"
                            class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Category</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('subcategories.index') }}"
                            class="nav-link {{ request()->routeIs('subcategories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Sub Category</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('description-pages.index') }}"
                            class="nav-link {{ request()->routeIs('description-pages.*') ? 'active' : '' }}">
                            <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6h16M4 10h16M4 14h10M4 18h6"></path>
                            </svg>
                            <p>Write Post</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('states.index') }}"
                            class="nav-link {{ request()->routeIs('states.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>State</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('education-jobs.index') }}"
                            class="nav-link {{ request()->routeIs('education-jobs.*') ? 'active' : '' }}">
                            <i class="fas fa-truck nav-icon"></i>
                            <p>Educations</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('jobbrand.index') }}"
                            class="nav-link {{ request()->routeIs('jobbrand.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>Job Brand</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>Company Setting</p>
                        </a>
                    </li>

                    @if(auth()->user()->role == 'saysadmin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('website-pages.index') }}"
                            class="nav-link {{ request()->routeIs('website-pages.*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>Pages</p>
                        </a>
                    </li>
                     <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Test
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <!-- Tests -->
                        <li class="nav-item">
                            <a href="{{ route('tests.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>All Tests</p>
                            </a>
                        </li>

                        <!-- Questions -->
                        <li class="nav-item">
                            <a href="{{ route('questions.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Questions</p>
                            </a>
                        </li>

                        <!-- Options -->
                        <li class="nav-item">
                            <a href="{{ route('options.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Options</p>
                            </a>
                        </li>

                    </ul>
                </li>

                    
                </ul>
            </nav>

            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->