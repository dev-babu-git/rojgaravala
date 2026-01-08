<!DOCTYPE html>
<html lang="en">

<head>

    @include('student.include.headerLink')

    @yield('styles')
</head>

<!-- ❌ layout-fixed removed -->

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        {{-- Header --}}
        @include('student.layout.header')

        {{-- Sidebar --}}
        @include('student.layout.sidebar')

        <!-- CONTENT -->
        <div class="content-wrapper">
            @yield('content')
        </div>


        <footer class="main-footer">
            <strong>Copyright &copy; 2014–{{ date('Y') }} Rojgarvala.</strong> All rights reserved.
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/adminlte.min.js') }}"></script>

    @yield('scripts')

</body>

</html>