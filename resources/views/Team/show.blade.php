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
        <div class="card">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 font-weight-normal my-5">LISTADO DE EQUIPOS</h1>
                <br>
                @can('teams.create')
                    <div class="card-body">
                        <div class="card-body">
                            <a href="{{ route('teams.create') }}" class="btn btn-lg btn-block btn-primary">CREAR EQUIPO</a>
                        </div>
                    @endcan
                    <br>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($teams->isEmpty())
                        <h3 class="text-danger text-center">No hay equipos</h3>
                        <p class="text-center">Por favor, cree un equipo primero <a href="{{ route('teams.create') }}">AQUÍ</a></p>
                    @else
                        <ul class="list-group">
                            @foreach ($teams as $team)
                                <li class="list-group-item">
                                    {{ $team->name }}
                                    <div class="btn-group float-right">
                                        @can('teams.edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('teams.edit', $team->id) }}">EDITAR</a>
                                            <form class="d-inline" action="{{ route('teams.destroy', $team->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-danger btn-sm" type="submit" value="ELIMINAR">
                                            </form>
                                        @endcan
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</body>

</html>
