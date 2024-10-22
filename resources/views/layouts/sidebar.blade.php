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
                <li class="nav-item" id="schools">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            School
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('school') }}" class="nav-link" id="schools-list">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>School List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('school.create') }}" class="nav-link" id="schools-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create School</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="departments">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Department
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('department') }}" class="nav-link" id="departments-list">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Department List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('department.create') }}" class="nav-link" id="departments-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create Department</p>
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
