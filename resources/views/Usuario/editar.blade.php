<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    @include('nav')
    <div class="container">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 font-weight-normal">EDITAR USUARIO</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class=" p-lg-5 mx-auto my-5">

            <form class="needs-validation" action="{{ route('usuario.update', $user) }}" method="post"
                autocomplete="off">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb 3">

                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                        <br>
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" value="{{ $user->email }}">
                        <br>
                        <label for="password">Contraseña</label>

                        <input class="form-control" type="password" name="password" value=""
                            placeholder="Digite la nueva contraseña, por favor">
                        <br>
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input class="form-control" type="password" name="password_confirmation" value=""
                            placeholder="Digite la nueva contraseña, por favor">
                        <br>
                        <label for="team_id">Equipo</label>
                        <select class="form-control" name="team_id" id="team_id">
                            <option value="">Seleccione un equipo</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $user->team_id ? 'selected' : '' }}>
                                    {{ $team->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="role_id">Rol</label>
                        <select class="form-control" name="role_id" id="role">
                            <option value="">Seleccione un rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-secondary" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>

@include('footer')

</body>

</html>
