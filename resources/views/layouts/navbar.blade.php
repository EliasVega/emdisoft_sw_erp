<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @can('branch.index')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="branch" class="nav-link">Sucursales</a>
            </li>
        @endcan
        @can('company.index')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="company" class="nav-link">Compañia</a>
            </li>
        @endcan
      </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown user-menu show">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                <span class="d-none d-md-inline">
                    {{ (Auth::user() ?? '') != '' ? Auth::user()->name : 'Emdisoft' }}
                    <i class="fas fa-chevron-circle-down"></i>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img class="img-circle elevation-2" src="{{ asset('images/admin/user.png') }}" alt="user Image">
                    <p>
                        {{ (Auth::user() ?? '') != '' ? Auth::user()->name : 'Emdisoft' }}
                        <small>
                            Miembro desde
                            {{ Auth::user()->created_at->format('Y-m-d') ?? '' }}
                        </small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="row">
                        <div class="col-12 text-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}" class="btn btn-danger btn-flat" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    {{ __('Cerrar Sesion') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
