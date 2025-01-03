<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NorthSize')</title>
    @include('layouts.style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">

        </div>

        <!-- Navbar -->
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="user-info text-center p-3 bg-dark rounded">
                <a href="{{ route('dashboard') }}" class="brand-link d-inline-flex align-items-center">
                    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3 me-2">
                    <p>Quản Lý Nhân Sự</p>
                </a>
            </div>
            <div class="d-flex flex-column justify-content-center align-items-start">
                <h1 class="text-white mb-2 mx-auto font-weight-bold">
                    {{ Auth::user()->name }}
                </h1>
                <!-- <p class="text-white-50 mb-0" style="font-size: 1rem;">
                    Welcome to your dashboard -->
                <!-- </p> -->
            </div>



            <!-- Sidebar -->

            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_dashboard'))
                                <a href="{{ route('dashboard') }}"
                                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clock"></i>
                                    <p>Chấm Công</p>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_user'))
                                <a href="{{ route('users.users') }}"
                                    class="nav-link {{ request()->routeIs('users.users') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Tài Khoản</p>
                                </a>
                            @endif
                        </li>

                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_department'))
                                <a href="{{ route('departments.index') }}"
                                    class="nav-link {{ request()->routeIs('departments.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>Phòng Ban</p>
                                </a>
                            @endif
                        </li>

                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_salarylevel'))
                                <a href="{{ route('salarylevels.index') }}"
                                    class="nav-link {{ request()->routeIs('salarylevels.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-money-check-alt"></i>
                                    <p>Bậc Lương</p>
                                </a>
                            @endif
                        </li>

                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_payroll'))
                                <a href="{{ route('payrolls.index') }}"
                                    class="nav-link {{ request()->routeIs('payrolls.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>Bảng Lương</p>
                                </a>
                            @endif
                        </li>

                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_justifications'))
                                <a href="{{ route('justifications.index') }}"
                                    class="nav-link {{ request()->routeIs('justifications.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-balance-scale"></i>
                                    <p>Duyệt Giải Trình</p>
                                </a>
                            @endif
                        </li>

                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_leaves'))
                                <a href="{{ route('leaves.index') }}"
                                    class="nav-link {{ request()->routeIs('leaves.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-paper-plane"></i>
                                    <p>Đề Xuất</p>
                                </a>
                            @endif
                        </li>

                        <li
                            class="nav-item has-treeview {{ request()->routeIs('configurations.*') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->routeIs('configurations.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Cấu Hình Chung
                                    <i class="nav-arrow fas fa-angle-right rotate-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('configurations.index') }}"
                                        class="nav-link {{ request()->routeIs('configurations.index') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-envelope"></i>
                                        <p>Cấu Hình Mail</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-tools"></i>
                                        <p>Cấu Hình Khác</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            @if (App\Helpers\PermissionHelper::can('view_charts'))
                                <a href="{{ route('charts.index') }}"
                                    class="nav-link {{ request()->routeIs('charts.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Biểu Đồ</p>
                                </a>
                            @endif
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- <h1 class="m-0">Dashboard</h1> -->
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('logout') }}">Logout</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong> &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('layouts.script')
</body>

</html>
