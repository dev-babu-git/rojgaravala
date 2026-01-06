 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.15); transition: 0.3s; }
        .test-card { cursor: pointer; }
        .navbar { background-color: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .avatar { width: 40px; height: 40px; object-fit: cover; }
    </style>
</head>
<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <!-- Logo / Brand -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('student.dashboard') }}">
            <i class="bi bi-mortarboard-fill me-2"></i> Student Portal
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#studentNavbar" 
            aria-controls="studentNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links & User -->
        <div class="collapse navbar-collapse" id="studentNavbar">
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Notifications (Optional) -->
                <li class="nav-item me-3">
                    <a class="nav-link position-relative" href="#">
                        <i class="bi bi-bell-fill fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('admin/img/avatar5.png') }}" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                        <span class="fw-semibold">{{ Auth::user()->name ?? 'Student' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li class="px-3 py-2">
                            <strong>{{ Auth::user()->name ?? '' }}</strong><br>
                            <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('student.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Optional Bootstrap Icons CDN -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> --}}

<!-- Dashboard Content -->
<!-- Page Content -->
    <div class="container my-5">
        @yield('content')
    </div>

    <!-- Footer -->
</body>
</html>
