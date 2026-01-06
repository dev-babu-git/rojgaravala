<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item ms-2">
            <strong>@yield('title')</strong>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-circle fa-lg"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow">
                <span class="dropdown-item-text fw-bold">
                    {{ auth()->user()->name }}
                </span>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" id="profileSettingsModal" class="dropdown-item">
                    <i class="fas fa-user-cog mr-2"></i> Profile
                </a>
                <form action="{{ route('student.logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </li>

    </ul>
</nav>
