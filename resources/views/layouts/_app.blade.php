<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.partials._html-head')

<body>
    <div id="wrapper">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light navbar-white shadow-sm" id="main_navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'My Applications') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                            <a class="nav-link dropdown-toggle {{ request()->is(['aplicacoes','servicos', 'integracoes']) ? 'active' : '' }}" href="#" id="dropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Minhas aplicações
                            </a>
                            <ul class="dropdown-menu dropright" aria-labelledby="dropdown1">
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item dropdown-toggle" href="#" id="dropdown1-1" data-toggle="dropdown" aria-expanded="false">Listar</a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown1-1-1">
                                        <li><a class="dropdown-item {{ request()->is('applicacoes') ? 'active' : '' }}" href="{{ route('applications.index') }}">Aplicações </a></li>
                                        <li><a class="dropdown-item {{ request()->is('servicos') ? 'active' : '' }}" href="{{ route('services.index') }}">Serviços </a></li>
                                        <li><a class="dropdown-item {{ request()->is('integracoes') ? 'active' : '' }}" href="{{ route('integrations.index') }}">Integrações </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('providers.index')
                        <li class="nav-item {{ request()->is('fornecedores') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('providers.index') }}">Fornecedores</a>
                        </li>
                        @endcan

                        @can('environments.index')
                        <li class="nav-item {{ request()->is('ambientes') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('environments.index') }}">Ambientes</a>
                        </li>
                        @endcan

                        @can('employees.index')
                        <li class="nav-item {{ request()->is('funcionarios') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('employees.index') }}">Funcionários</a>
                        </li>
                        @endcan

                        @can('towers.index')
                        <li class="nav-item {{ request()->is('torres') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('towers.index') }}">Torres</a>
                        </li>
                        @endcan

                        @can('servers.index')
                        <li class="nav-item {{ request()->is('servidores') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('servers.index') }}">Servidores</a>
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
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-header">
            <!-- Content Header (Page header) -->
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5 class="m-1 text-dark">{{ $page }}</h5>
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
            </div>
            <!-- /.content-header -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Main content -->
        <main class="container">
            @yield('content')
        </main>
        <!-- /.content -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- Scripts -->
    @include('layouts.partials._scripts')

</body>

</html>