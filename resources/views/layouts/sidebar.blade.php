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
                @if (Auth::user()->load('roleAssignments'))
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
                            <li class="nav-item">
                                <a href="{{ route('super.school.create') }}" class="nav-link" id="school-create">
                                    <i class="fas fa-angle-double-right nav-icon"></i>
                                    <p>Create School</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
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
                        <li class="nav-item">
                            <a href="{{ route('department.create') }}" class="nav-link" id="department-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create Department</p>
                            </a>
                        </li>
                    </ul>
                </li>
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
                        <li class="nav-item">
                            <a href="{{ route('group.create') }}" class="nav-link" id="group-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create Group</p>
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
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link" id="user-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create User</p>
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
