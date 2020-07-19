<!DOCTYPE html>
<html lang="pt-BR">

@include('layouts.partials._html-head')

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'My Applications') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav mr-auto">
                        @can('users.dashboard')
                        <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        @endcan

                        @can('applications.index')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['applications','services', 'integrations', 'details']) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Minhas aplicações
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->is('applications') ? 'active' : '' }}" href="{{ route('applications.index') }}">Aplicações</a>
                                <a class="dropdown-item {{ request()->is('services') ? 'active' : '' }}" href="{{ route('services.index') }}">Serviços</a>
                                <a class="dropdown-item {{ request()->is('integrations') ? 'active' : '' }}" href="{{ route('integrations.index') }}">Integrações</a>
                                <a class="dropdown-item {{ request()->is('details') ? 'active' : '' }}" href="{{ route('details.index') }}">Detalhes</a>
                            </div>
                        </li>
                        @endcan

                        <!-- @can('applications.index')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['aplicacoes','servicos', 'integracoes']) ? 'active' : '' }}" href="#" id="dropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Minhas aplicações
                            </a>
                            <ul class="dropdown-menu dropright" aria-labelledby="dropdown1">
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item dropdown-toggle" href="#" id="dropdown1-1" data-toggle="dropdown" aria-expanded="false">Listar</a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown1-1-1">
                                        <li><a class="dropdown-item {{ request()->is('applications') ? 'active' : '' }}" href="{{ route('applications.index') }}">Aplicações </a></li>
                                        <li><a class="dropdown-item {{ request()->is('services') ? 'active' : '' }}" href="{{ route('services.index') }}">Serviços </a></li>
                                        <li><a class="dropdown-item {{ request()->is('integrations') ? 'active' : '' }}" href="{{ route('integrations.index') }}">Integrações </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endcan-->

                        @can('providers.index')
                        <li class="nav-item {{ request()->is('providers') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('providers.index') }}">Fornecedores</a>
                        </li>
                        @endcan

                        <!-- @can('environments.index')
                        <li class="nav-item {{ request()->is('environments') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('environments.index') }}">Ambientes</a>
                        </li>
                        @endcan -->

                        @can('employees.index')
                        <li class="nav-item {{ request()->is('employees') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('employees.index') }}">Funcionários</a>
                        </li>
                        @endcan

                        @can('providers.index')
                        <li class="nav-item {{ request()->is('contacts') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contacts.index') }}">Contatos</a>
                        </li>
                        @endcan

                        @can('towers.index')
                        <li class="nav-item {{ request()->is('towers') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('towers.index') }}">Torres</a>
                        </li>
                        @endcan

                        @can('servers.index')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['servers', 'databases']) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Infraestrutura
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->is('environments') ? 'active' : '' }}" href="{{ route('environments.index') }}">Ambientes</a>
                                <a class="dropdown-item {{ request()->is('servers') ? 'active' : '' }}" href="{{ route('servers.index') }}">Servidores</a>
                                <a class="dropdown-item {{ request()->is('databases') ? 'active' : '' }}" href="{{ route('databases.index') }}">Banco de Dados</a>
                            </div>
                        </li>
                        @endcan

                        @can('access.control')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is(['usuarios','papeis', 'permissoes']) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Controle de Acesso
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->is('usuarios') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuários</a>
                                <a class="dropdown-item {{ request()->is('papeis') ? 'active' : '' }}" href="{{ route('roles.index') }}">Papéis</a>
                                <a class="dropdown-item {{ request()->is('permissoes') ? 'active' : '' }}" href="{{ route('permissions.index') }}">Permissões</a>
                            </div>
                        </li>
                        @endcan

                    </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if(Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <!-- <img src="img/default-150x150.png" width="25px" class="rounded-circle"
                                    data-holder-rendered="true" alt="User Image"> -->
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>

                    <!-- SEARCH FORM -->

                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
                    </li> -->
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="m-0 text-dark"> {{ $page }}
                                <!-- <small>Example 3.0</small> -->
                            </h5>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @if(request()->path() == 'home')
                                <div class="buscar-caja">
                                    <input type="text" id="search-app" name="search" class="buscar-txt" placeholder="Buscar ....." autocomplete="off" />
                                    <a class="buscar-btn"> <i class="fa fa-search"></i> </a>
                                </div>
                                @else
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ ucfirst(request()->path()) }}</li>
                                @endif
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">

                    @yield('content')

                </div><!-- /.container-fluid -->
            </div>
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

        <!-- Main Footer -->
        <footer class="main-footer shadow-sm">
            <div class="container">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    <!-- Conteudo -->
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2019 <a href="#">MyApplications</a>.</strong> {{__('All rights reserved.')}}
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Scripts -->
    @include('layouts.partials._scripts')

</body>

</html>