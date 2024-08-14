@include('backend.header');

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <img src="{{ asset('backend/img/favicon.jpg') }}" alt="">
                <span class="d-none d-lg-block">Ticketing Sys</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown">

                    @can('entry-create')
                    <a class="nav-link nav-icon" href="{{route('entry.create')}}">
                        <i class="bi bi-qr-code-scan"></i>
                    </a>
                    @endcan

                </li>
                <li class="nav-item dropdown">
                    
                    @can('ticket-create')
                    <a class="nav-link nav-icon" href="{{route('ticket.create')}}">
                        <i class="bi bi-cart3"></i>
                    </a>
                    @endcan

                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Profile"
                            class="rounded-circle">
                            @if(auth()->check())
                                <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                            @endif

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            @can('dashboard-index')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endcan

            @can('price-index')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('price.index') }}">
                    <i class="bi bi-buildings"></i>
                    <span>Add Ticket</span>
                </a>
            </li>
            @endcan

            @can('ride-index')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('ride.index') }}">
                    <i class="fa-brands fa-pushed"></i>
                    <span>Add Ride</span>
                </a>
            </li>
            @endcan

            @can('entry-index')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('entry.index') }}">
                    <i class="bi bi-qr-code-scan"></i>
                    <span>Entry Ticket </span>
                </a>
            </li>
            @endcan
            
            @can('ticket-index')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('ticket.index') }}">
                    <i class="bi bi-gem"></i>
                    <span>Ride Ticket </span>
                </a>
            </li>
            @endcan

            @can('index-report')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('report.index') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span> Report</span>
                </a>
            </li>
            @endcan

            @can('role-index')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('role.index') }}">
                    <i class="bi bi-shield-lock"></i>
                    <span>Role Permission</span>
                </a>
            </li>
            @endcan

            @can('user-index')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('user.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Manage Role</span>
                </a>
            </li>
            @endcan

            @can('profle-update')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('profle.update') }}">
                    <i class="bi bi-database-lock"></i>
                    <span>Password Update</span>
                </a>
            </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar-->

    {{-- ------------content part-------------- --}}
    @yield('content')
    {{-- ------------content part-------------- --}}

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Ticketing System</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://softxone.com/">SOFTxONE Limited</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('backend.footer');
</body>

</html>
