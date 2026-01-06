<aside class="main-sidebar sidebar-dark-info elevation-4">

    {{-- BRAND --}}
    <a href="{{ route('student.dashboard') }}" class="brand-link bg-info text-center">
        <span class="brand-text fw-bold text-white">
            Student Portal
        </span>
    </a>

    <div class="sidebar">

        {{-- USER INFO --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <i class="fas fa-user-circle fa-2x text-white"></i>
            </div>
            <div class="info">
                <span class="d-block text-white">
                    {{ auth()->user()->name }}
                </span>
            </div>
        </div>

        {{-- MENU --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('student.dashboard') }}"
                        class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
 
                <li class="nav-item">
                    <a href="{{ route('student.my-tests') }}"
                        class="nav-link {{ request()->routeIs('student.my-tests') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>My Tests</p>
                    </a>
                </li>

                {{-- PROFILE --}}
                <li class="nav-item">
                    <a href="{{ route('student.settings') }}"
                        class="nav-link {{ request()->routeIs('student.settings') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profile</p>
                    </a>
                </li>

                {{-- LOGOUT --}}
                <li class="nav-item mt-3">
                    <a href="#"
                        class="nav-link text-info"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>

        {{-- LOGOUT FORM --}}
        <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>
</aside>