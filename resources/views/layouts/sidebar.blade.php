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
                    <a href="#" class="nav-link" id="dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item" id="themes">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Themes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('themes') }}" class="nav-link" id="themes-index">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Theme List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('themes.create') }}" class="nav-link" id="themes-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create Theme</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="product">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-box"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products') }}" class="nav-link" id="product-index">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Product List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link" id="product-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="order">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-boxes"></i>
                        <p>
                            Orders
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders') }}" class="nav-link" id="order-index">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Orders List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.create') }}" class="nav-link" id="order-create">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Create Order</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" id="delivery">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-dolly"></i>
                        <p>
                            Deliveries
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders') }}" class="nav-link" id="delivery-index">
                                <i class="fas fa-angle-double-right nav-icon"></i>
                                <p>Deliveries List</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
