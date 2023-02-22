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
            <h1 class="display-4 font-weight-normal ">CREAR NUEVO COLABORADOR</h1>
        </div>

        <div class=" p-lg-5 mx-auto my-5">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form class="needs-validation" action="{{ route('partners.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class=" mb-3">

                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email">

                        <label for="team_id">Equipo</label>
                        @if ($teams->isEmpty())
                            <h3 style="color: red; text-decoration: underline">No hay equipos</h3>
                            <p>Por favor, cree un equipo primero <a href="{{ route('teams.create') }}">AQUÍ</a></p>
                        @else
                            <div class="col-md-5 mb-3">

                                <select class="custom-select d-block w-100" name="team_id" id="team_id">
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="submit" class="btn btn-secondary" value="Enviar">
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('footer')

</body>

</html>
