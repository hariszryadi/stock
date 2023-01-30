<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="index.html">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider">One<span class="fw-normal">UI</span></span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Dark Mode -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                data-action="dark_mode_toggle">
                <i class="far fa-moon"></i>
            </button>
            <!-- END Dark Mode -->

            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout"
                data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="nav-main-link-icon fa fa-dashboard"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item {{ request()->is('basic_material') || request()->is('basic_material/*') || request()->is('finished_material') || request()->is('finished_material/*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="{{ request()->is('basic_material') || request()->is('basic_material/*') || request()->is('finished_material') || request()->is('finished_material/*') ? 'true' : 'false' }}" href="#">
                        <i class="nav-main-link-icon fa fa-database"></i>
                        <span class="nav-main-link-name">Stok</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('basic_material') || request()->is('basic_material/*') ? 'active' : '' }}" href="{{ route('basic_material.index') }}">
                                <span class="nav-main-link-name">Bahan Dasar</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('finished_material') || request()->is('finished_material/*') ? 'active' : '' }}" href="{{ route('finished_material.index') }}">
                                <span class="nav-main-link-name">Bahan Jadi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{ request()->is('basic_material_in') || request()->is('basic_material_in/*') || request()->is('finished_material_in') || request()->is('finished_material_in/*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="{{ request()->is('basic_material_in') || request()->is('basic_material_in/*') || request()->is('finished_material_in') || request()->is('finished_material_in/*') ? 'true' : 'false' }}" href="#">
                        <i class="nav-main-link-icon fa fa-sign-in-alt"></i>
                        <span class="nav-main-link-name">Barang Masuk</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('basic_material_in') || request()->is('basic_material_in/*') ? 'active' : '' }}" href="{{ route('basic_material_in.index') }}">
                                <span class="nav-main-link-name">Bahan Dasar</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('finished_material_in') || request()->is('finished_material_in/*') ? 'active' : '' }}" href="{{ route('finished_material_in.index') }}">
                                <span class="nav-main-link-name">Bahan Jadi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{ request()->is('basic_material_out') || request()->is('basic_material_out/*') || request()->is('finished_material_out') || request()->is('finished_material_out/*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="{{ request()->is('basic_material_out') || request()->is('basic_material_out/*') || request()->is('finished_material_out') || request()->is('finished_material_out/*') ? 'true' : 'false' }}" href="#">
                        <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
                        <span class="nav-main-link-name">Barang Keluar</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('basic_material_out') || request()->is('basic_material_out/*') ? 'active' : '' }}" href="{{ route('basic_material_out.index') }}">
                                <span class="nav-main-link-name">Bahan Dasar</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('finished_material_out') || request()->is('finished_material_out/*') ? 'active' : '' }}" href="{{ route('finished_material_out.index') }}">
                                <span class="nav-main-link-name">Bahan Jadi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{ request()->is('recap_basic_material') || request()->is('recap_basic_material/*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="{{ request()->is('recap_basic_material') || request()->is('recap_basic_material/*') ? 'true' : 'false' }}" href="#">
                        <i class="nav-main-link-icon fa fa-file-text"></i>
                        <span class="nav-main-link-name">Rekapitulasi</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('recap_basic_material') || request()->is('recap_basic_material/*') ? 'active' : '' }}" href="{{ route('recap_basic_material.index') }}">
                                <span class="nav-main-link-name">Bahan Dasar</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#">
                                <span class="nav-main-link-name">Bahan Jadi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-item {{ request()->is('user') || request()->is('user/*') ? 'open' : '' }}">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="{{ request()->is('user') || request()->is('user/*') ? 'true' : 'false' }}" href="#">
                        <i class="nav-main-link-icon fa fa-user"></i>
                        <span class="nav-main-link-name">User Management</span>
                    </a>
                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="#">
                                <span class="nav-main-link-name">Role</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link {{ request()->is('user') || request()->is('user/*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                                <span class="nav-main-link-name">User</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>