<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="navbar-header" style="height: 6.45rem !important">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">


                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <h2 style="" class="brand-text">{{ env('APP_NAME') }}</h2>

                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class="nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">Insights</span>
                </a>
            </li>

            <li class="nav-item {{ \Str::is('admin.quotes*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.quotes.index') }}">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate">Quote Management</span>
                </a>
            </li>

            <li class="nav-item {{ \Str::is('admin.trips*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.trips.index') }}">
                    <i data-feather="map"></i> {{-- Use map icon for trips --}}
                    <span class="menu-title text-truncate">Trips</span>
                </a>
            </li>


            <li class="nav-item {{ \Str::is('admin.clients*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.clients.index') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">Client Management</span>
                </a>
            </li>


            @if (auth()->user() && auth()->user()->role == 'admin')
                <li class="nav-item {{ \Str::is('admin.agents*', request()->route()->getName()) ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('admin.agents.index') }}">
                        <i data-feather="user-check"></i>
                        <span class="menu-title text-truncate">Agent Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="layers"></i>
                        <span class="menu-title text-truncate">Attributes</span>
                    </a>

                    <ul class="menu-content">
                        <li
                            class="nav-item {{ \Str::is('admin.airplanes*', request()->route()->getName()) ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('admin.airplanes.index') }}">
                                <i data-feather="airplay"></i>
                                <span class="menu-title text-truncate">Airplane</span>
                            </a>
                        </li>

                        <li
                            class="nav-item {{ \Str::is('admin.airpots*', request()->route()->getName()) ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('admin.airpots.index') }}">
                                <i data-feather="map-pin"></i>
                                <span class="menu-title text-truncate">Airport</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ \Str::is('admin.logs*', request()->route()->getName()) ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('admin.logs.index') }}">
                        <i data-feather="activity"></i>
                        <span class="menu-title text-truncate">Logs</span>
                    </a>
                </li>
            @endif





            <li class="nav-item {{ \Str::is('admin.notifications*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.notifications.index') }}">
                    <i data-feather="bell"></i>
                    <span class="menu-title text-truncate">Notification</span>
                </a>
            </li>



            <li class="nav-item">
                <a data-bs-toggle="modal" data-bs-target="#logout" class="d-flex align-items-center" href="#">
                    <i data-feather="power"></i>
                    <span class="menu-title text-truncate">Logout</span>
                </a>
            </li>








        </ul>



    </div>
</div>




<div class="modal fade modal-danger text-start" id="logout" tabindex="-1" aria-labelledby="logoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to log out? This action will end your current session.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.logout') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-danger">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END: Main Menu-->
