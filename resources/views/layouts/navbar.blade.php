<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button "><i class="fas fa-bars cl-icon"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="breadcrumb-item">
            @if (!Session()->has('empresa'))
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}" class="btn btn-celeste" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    {{ __('Cerrar Sesion') }}
                </a>
            </form>
            @elseif(Session()->has('empresa') && !Session()->has('sede'))
                <form method="POST" action="{{ route('logoutEmpresa') }}">
                    @csrf

                    <a href="{{ route('logoutEmpresa') }}" class="btn btn-loglila" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Salir Empresa') }}
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-celeste" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Cerrar Sesion') }}
                    </a>
                </form>

            @elseif(Session()->has('empresa') && Session()->has('sede'))
                <form method="POST" action="{{ route('logoutSede') }}">
                    @csrf
                    <a href="{{ route('logoutSede') }}" class="btn btn-logfucsia" onclick="event.preventDefault();
                    this.closest('form').submit();">
                        {{ __('Salir Sucursal') }}
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-celeste" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Cerrar Sesion') }}
                    </a>
                </form>
            @endif
        </li>
    </ul>
</nav>
<!-- /.navbar -->
