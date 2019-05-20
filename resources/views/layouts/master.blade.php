<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Auth::user()->pharmacy->name }} | SisFarma</title>
    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Configuración</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="home" class="brand-link">
            <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">-->
            <span class="brand-text font-weight-light">Farmacia Castillo</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Usuario: {{ Auth::user()->nombre }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-header">NEGOCIO</li>
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }} {{ Request::routeIs('sale.*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-shopping-cart"></i>
                            <p>
                                Ventas
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('sale.now')}}" class="nav-link {{ Request::routeIs('sale.now') ? 'active' : '' }} {{ Request::routeIs('home') ? 'active' : '' }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Vender</p>
                                </a>
                            </li>
                            @if (Auth::user()->rol === 'admin' || Auth::user()->rol === 'tera')
                                <li class="nav-item">
                                    <a href="/sale/search/now" class="nav-link {{ Request::routeIs('sale.search') ? 'active' : '' }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Reporte diario</p>
                                    </a>
                                </li>
                            @endif
                            <!--<li class="nav-item">
                                <a href="{{route('sale.index')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Resumen mensual</p>
                                </a>
                            </li>-->
                        </ul>
                    </li>
                    <!--- ADMIN-->
                    @if (Auth::user()->rol === 'admin' || Auth::user()->rol === 'tera')
                        <li class="nav-item">
                            <a href="{{ route('inventory.index') }}" class="nav-link {{ Request::routeIs('inventory.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-list"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/expense/search/now" class="nav-link {{ Request::routeIs('expense.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-money-bill-alt"></i>
                                <p>Gastos</p>
                            </a>
                        </li>
                        <li class="nav-header">ADMINISTRACIÓN</li>
                        <li class="nav-item">
                            <a href="{{route('medicament.index')}}" class="nav-link {{ Request::routeIs('medicament.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-pills"></i>
                                <p>Medicamentos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('principle.index') }}" class="nav-link {{ Request::routeIs('principle.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-vials"></i>
                                <p>Principios activos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laboratory.index') }}" class="nav-link {{ Request::routeIs('laboratory.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-flask"></i>
                                <p>Laboratorios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('customer.index')}}" class="nav-link {{ Request::routeIs('customer.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link {{ Request::routeIs('user.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-user"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-header">SISTEMA</li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-sign-out-alt"></i>
                            <p>Salir</p>
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
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2019 <a href="http://tera.pe">Tera - Soluciones Digitales | SisFarma</a>.</strong>
        Todos los derechos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0-alpha
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('layouts.scripts');
</body>
</html>
