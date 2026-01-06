<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Student Dashboard</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">

    <style>
        .bg-info-soft {
            background: #17a2b8 !important;
            color: #fff;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            transition: 0.3s;
        }
    </style>

    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    @include('student.layout.header')
    @include('student.layout.sidebar')

    <!-- CONTENT -->
    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>

@yield('scripts')

</body>
</html>
