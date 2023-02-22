<footer class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto">
                <h6 class="text-uppercase font-weight-bold mb-4">FORMULARIO DE CALIFICACIÓN INTERNA - SEREMPRE</h6>
                <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis.</p>
            </div>
            @can('roles.show')
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                    <h6 class="text-uppercase font-weight-bold mb-4">Secciones</h6>
                    <p><a href="{{ route('usuario.show') }}" class="text-reset">Usuarios</a></p>
                    <p><a href="{{ route('roles.show') }}" class="text-reset">Roles</a></p>
                    <p><a href="{{ route('teams.show') }}" class="text-reset">Equipos</a></p>
                    <p><a href="{{ route('partners.show') }}" class="text-reset">Colaboradores</a></p>
                </div>
            @endcan
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                <h6 class="text-uppercase font-weight-bold mb-4">Resultados y Formularios</h6>
                @can('resumen')
                    <p><a href="{{ route('formulario.resumen') }}" class="text-reset">Resultados individuales y por equipo</a></p>
                @endcan
                <p><a href="{{ route('formulario.index') }}" class="text-reset">Presentar nuevamente el formulario</a>
                </p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto">
                <h6 class="text-uppercase font-weight-bold mb-4">Contacto</h6>
                <p class="text-muted">Bogotá D.C, Colombia</p>
                <p><a href="mailto:serempre@serempre.com" class="text-reset">serempre@serempre.com</a></p>
                <p>+ 01 234 567 88</p>
                <p>+ 01 234 567 89</p>
            </div>
        </div>
    </div>
    <div class="bg-dark text-white py-4">
        <div class="container text-center">
            © 2023 Copyright: Gabriel Castillo
        </div>
    </div>
</footer>
