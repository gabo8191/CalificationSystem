<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <a class="navbar-brand text-white" href="{{ route('formulario.index') }}">{{ env('APP_NAME') }}</a>
    <ul class="nav justify-content-center">
        @can('formulario.index')
            <li class="nav-item">
                <a class="nav-link text-black btn" href="{{ route('formulario.index') }}">Formulario</a>
            </li>
        @endcan
        @can('resumen')
            <li class="nav-item active">
                <a class="nav-link text-white" href="{{ route('formulario.resumen') }}">Ver resumen de resultados</a>
            </li>
        @endcan
        @can('usuario.show')
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('usuario.show') }}">Ver Usuarios</a>
            </li>
        @endcan
        @can('roles.show')
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('roles.show') }}">Roles</a>
            </li>
        @endcan
        @can('pregunta.show')
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('pregunta.show') }}">Preguntas</a>
            </li>
        @endcan
        @can('partners.show')
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('partners.show') }}">Colaboradores</a>
            </li>
        @endcan
        @can('teams.show')
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('teams.show') }}">Equipos</a>
            </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link btn btn-danger text-white" href="{{ route('logout') }}">Salir</a>
        </li>
    </ul>
</nav>
