<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand -->
    <a href="{{ route('student.dashboard') }}" class="brand-link text-center">
        <span class="brand-text fw-bold">Student Portal</span>
    </a>

    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('student.dashboard') }}"
                       class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Exams & Tests -->
                <li class="nav-item has-treeview {{ request()->routeIs('student.tests.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('student.tests.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Tests
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('student.tests.index') }}"
                               class="nav-link {{ request()->routeIs('student.tests.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Tests</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Results -->
                <li class="nav-item">
                    <a href="#"
                       class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Results</p>
                    </a>
                </li>

                <!-- Profile -->
                <li class="nav-item">
                    <a href="javascript:void(0)"
                       id="profileSettingsModal"
                       class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profile</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <form action="{{ route('student.logout') }}" method="POST">
                        @csrf
                        <button class="nav-link btn btn-link text-left text-danger">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
