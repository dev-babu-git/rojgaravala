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
    <aside class="main-sidebar sidebar-dark-info elevation-4">

        <!-- Brand -->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('admin/img/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{ auth()->user()->name }}</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                    <!-- ================= DASHBOARD ================= -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- ================= CATEGORY ================= -->
                    <li class="nav-item has-treeview {{ request()->routeIs('categories.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Category <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories.create') }}" class="nav-link {{ request()->routeIs('categories.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- ================= SUB CATEGORY ================= -->
                    <li class="nav-item has-treeview {{ request()->routeIs('subcategories.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('subcategories.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>Sub Category <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('subcategories.index') }}" class="nav-link {{ request()->routeIs('subcategories.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Sub Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subcategories.create') }}" class="nav-link {{ request()->routeIs('subcategories.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Sub Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{ request()->routeIs('description-pages.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('description-pages.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Description Pages
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            {{-- All Pages --}}
                            <li class="nav-item">
                                <a href="{{ route('description-pages.index') }}"
                                    class="nav-link {{ request()->routeIs('description-pages.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Pages</p>
                                </a>
                            </li>

                            {{-- Create Page --}}
                            <li class="nav-item">
                                <a href="{{ route('description-pages.create') }}"
                                    class="nav-link {{ request()->routeIs('description-pages.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Page</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <!-- ================= EXAMS ================= -->
                    <li class="nav-item has-treeview {{ request()->routeIs('exams.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('exams.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Exams <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('exams.index') }}" class="nav-link {{ request()->routeIs('exams.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Exams</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('exams.create') }}" class="nav-link {{ request()->routeIs('exams.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Exam</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- ================= TESTS ================= -->
                    <li class="nav-item has-treeview {{ request()->routeIs('tests.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('tests.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Tests <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tests.index') }}" class="nav-link {{ request()->routeIs('tests.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Tests</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tests.create') }}" class="nav-link {{ request()->routeIs('tests.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Test</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- ================= QUESTIONS ================= -->
                    <li class="nav-item has-treeview {{ request()->routeIs('questions.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('questions.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>Questions <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('questions.index') }}" class="nav-link {{ request()->routeIs('questions.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Questions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('questions.create') }}" class="nav-link {{ request()->routeIs('questions.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Question</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- ================= OPTIONS ================= -->
                    <li class="nav-item has-treeview {{ request()->routeIs('options.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('options.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>Options <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('options.index') }}" class="nav-link {{ request()->routeIs('options.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Options</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('options.create') }}" class="nav-link {{ request()->routeIs('options.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Option</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- ================= PAGES ================= -->
                    <li class="nav-item has-treeview {{ request()->routeIs('website-pages.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('website-pages.*') ? 'active' : '' }}">
                            <i class="nav-icon far fa-file-alt"></i>
                            <p>Pages <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('website-pages.index') }}" class="nav-link {{ request()->routeIs('website-pages.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Pages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('website-pages.create') }}" class="nav-link {{ request()->routeIs('website-pages.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Page</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- ================= USERS ================= -->
                    @if(auth()->user()->role == 'saysadmin')
                    <li class="nav-item has-treeview {{ request()->routeIs('users.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </aside>