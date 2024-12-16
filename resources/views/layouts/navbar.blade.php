<nav class="main-header navbar navbar-expand navbar-dark bg-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a data-toggle="dropdown" href="#">
                <img src="{{ Auth::user()->image_url ?? asset('vendor/adminlte/dist/img/user8-128x128.jpg') }}"
                     alt="avatar" class="img-circle brand-image" style="width: 30px; height: 30px; object-fit: cover;">
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="/" class="dropdown-item">
                    <i class="fas fa-user mr-2 text-success"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="dropdown-item"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2 text-danger"></i> Log Out
                </a>
            </div>
        </li>
    </ul>
</nav>
