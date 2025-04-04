<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakila Admin - Laravel</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <style>
        .sidebar {
            overflow-y: auto;
            max-height: calc(100vh - 4.5rem);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Inicio</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <span class="brand-text font-weight-light">Sakila Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                {{-- filepath: c:\Users\panch\Documents\Proyectos\Practicas Elias\Sakila\resources\views\layouts\app.blade.php --}}
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @php
                            $userRole = auth()->user()->role->name; // Obtiene el rol del usuario autenticado
                        @endphp
                
                        {{-- Opciones visibles para todos los roles --}}
                        <li class="nav-item">
                            <a href="{{ route('films.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-film"></i>
                                <p>Películas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('actors.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>Actores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inventories.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                
                        {{-- Opciones adicionales visibles solo para roles distintos de "cliente" --}}
                        @if ($userRole !== 'cliente')
                            <li class="nav-item">
                                <a href="{{ route('addresses.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-map-marker-alt"></i>
                                    <p>Direcciones</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cities.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-city"></i>
                                    <p>Ciudades</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('countries.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-globe"></i>
                                    <p>Países</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customers.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Clientes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('film-actors.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>Actores de Películas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('film-categories.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Categorías de Películas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('film_texts.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Textos de Películas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('languages.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-language"></i>
                                    <p>Idiomas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payments.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-credit-card"></i>
                                    <p>Pagos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rentals.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-handshake"></i>
                                    <p>Alquileres</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('staffs.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-id-badge"></i>
                                    <p>Personal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stores.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-store"></i>
                                    <p>Tiendas</p>
                                </a>
                            </li>
                        @endif
                
                        {{-- Opción de cerrar sesión visible para todos --}}
                        <li class="nav-item mt-3">
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="nav-link text-danger">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Cerrar Sesión</p>
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
                            <h1 class="m-0">Sakila Admin</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Sakila Admin - Laravel</strong>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('scripts')
</body>
</html>