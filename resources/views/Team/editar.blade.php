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
            <h1 class="display-4 font-weight-normal">EDITAR EQUIPO</h1>
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

            <form class="needs-validation" action="{{ route('teams.update', $team->id) }}" method="POST"
                autocomplete="off">
                @csrf
                @method('PUT')
                <label for="name">Nombre del equipo:</label>
                <input class="form-control" type="text" name="name" value="{{ $team->name }}">
                <br>
                <input type="submit" class="btn btn-secondary" value="Enviar">


            </form>
        </div>
    </div>
    @include('footer')
</body>

</html>
