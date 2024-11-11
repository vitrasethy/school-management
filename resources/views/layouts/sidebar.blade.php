<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false" id="sidebar">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" id="dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->is_super_admin)
                    <li class="nav-item" id="school">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-school"></i>
                            <p>
                                School
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('super.school.show') }}" class="nav-link" id="school-show">
                                    <i class="fas fa-angle-double-right nav-icon"></i>
                                    <p>School List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item" id="setting">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Setting
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('super.school.show') }}" class="nav-link" id="role">
                                    <i class="fas fa-angle-double-right nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                @endif
                @if (Auth::user()->role_id == 1 || Auth::user()->is_super_admin)
                    <li class="nav-item" id="department">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-building"></i>
                            <p>
                                Department
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('department.show') }}" class="nav-link" id="department-show">
                                    <i class="fas fa-angle-double-right nav-icon"></i>
                                    <p>Department List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item" id="group">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Group
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('group.show') }}" class="nav-link" id="group-show">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Group List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="user">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.show') }}" class="nav-link" id="user-show">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
