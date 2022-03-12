@props(['activeMenu' => '', 'activePage' => '', 'pageTitle' => 'Starter Page'])

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ auth()->user()->name }}</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav" style="display: flex !important; width: 100%; justify-content: space-between;">
        <li class="nav-item" style="display: flex !important;">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block" style="display: flex !important;">
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <input type="submit" class="nav-link" value="Logout">
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <div class="brand-link">
        <span class="brand-text font-weight-light">{{ auth()->user()->name }}</span>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ $activePage === 'home' ? 'active' : '' }}">
                  {{-- <i class="nav-icon fas fa-th"></i> --}}
                  <i class="nav-icon fab fa-airbnb"></i>
                  <p>Home</p>
                </a>
              </li>
            
            <li class="nav-item {{ $activeMenu === 'storages' ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ $activeMenu === 'storages' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Storages
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('storages.add') }}" class="nav-link {{ $activePage === 'storages.add' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('storages.edit') }}" class="nav-link {{ $activePage === 'storages.edit' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('storages.remove') }}" class="nav-link {{ $activePage === 'storages.remove' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Remove</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item {{ $activeMenu === 'items' ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ $activeMenu === 'items' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Items
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('items.add') }}" class="nav-link {{ $activePage === 'items.add' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('items.edit') }}" class="nav-link {{ $activePage === 'items.edit' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('items.remove') }}" class="nav-link {{ $activePage === 'items.remove' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Remove</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item {{ $activeMenu === 'storageItems' ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ $activeMenu === 'storageItems' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Supplies
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('storage.items.add') }}" class="nav-link {{ $activePage === 'storageItems.add' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('storage.items.edit') }}" class="nav-link {{ $activePage === 'storageItems.edit' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('storage.items.remove') }}" class="nav-link {{ $activePage === 'storageItems.remove' ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Remove</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="{{ route('order.create') }}" class="nav-link {{ $activePage === 'order' ? 'active' : '' }}">
                {{-- <i class="nav-icon fas fa-th"></i> --}}
                <i class="nav-icon fab fa-airbnb"></i>
                <p>Create an order</p>
              </a>
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
            <div class="col-sm-12">
              <h1 class="m-0">{{ $pageTitle }}</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      {{ $slot }}
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>