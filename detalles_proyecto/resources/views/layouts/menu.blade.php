<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ asset('detalles.jpg') }}" height="35px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                @if (!Session::get('usuario'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/session') }}">Login</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/articulos') }}">Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contactos') }}">Clientes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ventasDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Ventas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="ventasDropdown">
                        <a class="dropdown-item" href="{{ url('/ventas/contados') }}">Contado</a>
                        <a class="dropdown-item" href="{{ url('/ventas/creditos') }}">Crédito</a>
                        <a class="dropdown-item" href="{{ url('/ventas/apartados') }}">Apartado</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/abonos') }}">Abonos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/contactos') }}">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/create') }}">Registro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Cerrar sesión</a>
                </li>
                @endif
            </ul>
            <span class="navbar-text">
                Decoración de hogar y Expresión Social
            </span>
        </div>
    </div>
</nav>
