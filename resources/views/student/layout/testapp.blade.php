<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Student Dashboard')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">

    <style>
        
        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: #fff !important;
        }
        .navbar-custom .nav-link:hover {
            color: #e2e6ea !important;
        }
        .user-img {
            width: 36px;
            height: 36px;
            object-fit: cover;
        }
    </style>

    @yield('styles')
</head>

<body class="hold-transition layout-top-nav">

<div class="wrapper">

    <!-- TOP NAVBAR -->
    <nav class="main-header navbar bg-info navbar-expand navbar-custom">
        <div class="container">

            <!-- Brand -->
            <a href="{{ route('student.dashboard') }}" class="navbar-brand font-weight-bold">
                <i class="fas fa-user-graduate mr-2"></i> Student Portal
            </a>

            <!-- Right navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">3 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> New message
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All</a>
                    </div>
                </li> -->

                <!-- User Menu -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('admin/img/avatar5.png') }}"
                             class="user-img img-circle elevation-2"
                             alt="User Image">
                        <span class="d-none d-md-inline">
                            {{ Auth::user()->name ?? 'Student' }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <li class="user-header bg-primary">
                            <img src="{{ asset('admin/img/avatar5.png') }}"
                                 class="img-circle elevation-2"
                                 alt="User Image">
                            <p>
                                {{ Auth::user()->name ?? '' }}
                                <small>{{ Auth::user()->email ?? '' }}</small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <form action="{{ route('student.logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-block">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="content-wrapper">
        <div class="content pt-4">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

</div>

<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>

@yield('scripts')

</body>
</html>
