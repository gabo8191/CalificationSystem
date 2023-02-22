<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    @vite(['resources/js/app.js'])
</head>

<body>
    @include('nav')

    <div class="container">
        <div class="card">
            <div class="col-md-5 p-lg-5 mx-auto my-5">
                <h1 class="display-4 font-weight-normal my-5">LISTADO DE PREGUNTAS</h1>
                <br>
                @can('pregunta.create')
                    <div class="card-body">
                        <div class="card-body">
                            <a href="{{ route('pregunta.create') }}" class="btn btn-lg btn-block btn-primary">Crear Pregunta</a>
                        </div>
                    @endcan
                    <br>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($preguntas->isEmpty())
                        <h3 class="text-danger text-center">No hay preguntas registradas</h3>
                    @else
                        <ul class="list-group">
                            @foreach ($preguntas as $pregunta)
                                <li class="list-group-item">
                                    {{ $pregunta->concepto_pregunta }}
                                    <div class="btn-group float-right">
                                        @can('pregunta.edit')
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('pregunta.edit', $pregunta) }}">Editar</a>
                                            <form class="d-inline" action="{{ route('pregunta.destroy', $pregunta) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-danger btn-sm" type="submit" value="Eliminar">
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
