<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ Auth::user()->school->image ?? asset('vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        @role('super admin')
        <span class="brand-text font-weight-light">AdminLTE</span>
        @endrole
        @role('school admin')
        <span class="brand-text font-weight-light">{{Auth::user()->school->abbr}}</span>
        @endrole
        @role('department admin')
        <span
            class="brand-text font-weight-light">{{Auth::user()->school->abbr.' - '.Auth::user()->department->abbr}}</span>
        @endrole
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false" id="sidebar">
                <li class="nav-item" id="dashboard">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- @if (Auth::user()->getRoleNames()->contains('super admin'))
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
                @endif --}}
                @can('view all schools')
                    <li class="nav-item" id="school">
                        <a href="{{route('super.school.show')}}" class="nav-link">
                            <i class="nav-icon fas fa-school"></i>
                            <p>
                                School
                            </p>
                        </a>
                        {{--                                                <a href="#" class="nav-link">--}}
                        {{--                                                    <i class="nav-icon fas fa-school"></i>--}}
                        {{--                                                    <p>--}}
                        {{--                                                        School--}}
                        {{--                                                        <i class="right fas fa-angle-left"></i>--}}
                        {{--                                                    </p>--}}
                        {{--                                                </a>--}}
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{ route('super.school.show') }}" class="nav-link" id="school-show">--}}
                        {{--                                    <i class="fas fa-angle-double-right nav-icon"></i>--}}
                        {{--                                    <p>School List</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                    </li>
                @endcan
                @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('school admin'))
                    <li class="nav-item" id="department">
                        <a href="{{route('department.show')}}" class="nav-link">
                            <i class="nav-icon fa fa-building"></i>
                            <p>
                                Department
                            </p>
                        </a>
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{ route('department.show') }}" class="nav-link" id="department-show">--}}
                        {{--                                    <i class="fas fa-angle-double-right nav-icon"></i>--}}
                        {{--                                    <p>Department List</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                    </li>
                @endif
                <li class="nav-item" id="subject">
                    <a href="{{route('subject.show')}}" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Subject
                        </p>
                    </a>
                    {{--                    <ul class="nav nav-treeview">--}}
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a href="{{ route('subject.show') }}" class="nav-link" id="department-show">--}}
                    {{--                                <i class="fas fa-angle-double-right nav-icon"></i>--}}
                    {{--                                <p>Subject List</p>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                </li>
                <li class="nav-item" id="group">
                    <a href="{{route('group.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Group
                        </p>
                    </a>
                    {{--                    <ul class="nav nav-treeview">--}}
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a href="{{ route('group.index') }}" class="nav-link" id="group-show">--}}
                    {{--                                <i class="fas fa-angle-double-right nav-icon"></i>--}}
                    {{--                                <p>Group List</p>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                </li>
                <li class="nav-item" id="user">
                    <a href="{{route('staff.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                    {{--                    <ul class="nav nav-treeview">--}}
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a href="{{ route('staff.index') }}" class="nav-link" id="user-show">--}}
                    {{--                                <i class="fas fa-angle-double-right nav-icon"></i>--}}
                    {{--                                <p>Users</p>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
