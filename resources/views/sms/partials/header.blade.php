<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <p class="nav-link mb-0">{{ session('society_name') }}</p>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <img src="{{ url('assets/images/' . session('profile_pic')) }}" alt="profile_pic" height="30px"
                        width="30px" style="border-radius: 30px;">
                    {{ session('first_name') }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="{{ route('settings.my.profile') }}" class="dropdown-item">
                        <div class="media">
                            <div class="media-body  d-flex">
                                <p><i class="nav-icon fas fa fa-user fa-sm"></i><span class="ms-2">Profile</span></p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('settings.credentials') }}" class="dropdown-item">
                        <div class="media">
                            <div class="media-body  d-flex">
                                <p><i class="nav-icon fas fa fa-key fa-sm"></i><span class="ms-2">Credentials</span>
                                </p>
                            </div>
                        </div>
                    </a>
                    @if (session('role') == 'admin')
                    <div class="dropdown-divider"></div>
                        <a href="{{ route('settings.society.profile') }}" class="dropdown-item">
                            <div class="media">
                                <div class="media-body d-flex">
                                    <p><i class="nav-icon fas fa fa-building fa-sm"></i><span class="ms-2">Society
                                            Profile</span></p>
                                </div>
                            </div>
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <div class="media">
                            <div class="media-body d-flex">
                                <p><i class="nav-icon fas fa fa-power-off fa-sm"></i><span class="ms-2">Logout</span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="{{ url('assets/images/sms_tansparent_logo.png') }}" alt="sms_logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SMS</span>
            <br>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="" class="d-block">
                        <i class="nav-icon mr-2">
                            <img src="{{ url('assets/images/' . session('profile_pic')) }}" alt="profile_pic"
                                style="border-radius: 50px;">
                        </i>
                        {{ 'Welcome ' . session('first_name') }}
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
            <a href="{{ route('maintenance') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Maintenance</p>
            </a>
          </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('account') }}" class="nav-link">
                            <i class="nav-icon fas fa-sticky-note"></i>
                            <p>Account</p>
                        </a>
                    </li>
                    @if (session('role') == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('members') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Members</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('suggested.works') }}" class="nav-link">
                            <i class="nav-icon fas fa fa-superpowers"></i>
                            <p>Suggested Works</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('fund.raising') }}" class="nav-link">
                            <i class="nav-icon fas fa fa-sun-o"></i>
                            <p>Fund Raising</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('notice.board') }}" class="nav-link">
                            <i class="nav-icon fas fa fa-thumb-tack"></i>
                            <p>Notice Board</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-wrench"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ms-4">
                                <a href="{{ route('settings.my.profile') }}" class="nav-link">
                                    <i class="nav-icon fas fa fa-user"></i>
                                    <p>My Profile</p>
                                </a>
                            </li>
                            <li class="nav-item ms-4">
                                <a href="{{ route('settings.credentials') }}" class="nav-link">
                                    <i class="nav-icon fas fa fa-key"></i>
                                    <p>Credentials</p>
                                </a>
                            </li>
                            @if (session('role') == 'admin')
                                <li class="nav-item ms-4">
                                    <a href="{{ route('settings.society.profile') }}" class="nav-link">
                                        <i class="nav-icon fas fa fa-building"></i>
                                        <p>Society Profile</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fas fa fa-power-off"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
