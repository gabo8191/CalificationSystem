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
            <h1 class="display-4 font-weight-normal">EDITAR COLABORADOR</h1>
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


            <form class="needs-validation" action="{{ route('partners.update', $partner) }}" method="post"
                autocomplete="off">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class=" mb-3">

                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre"
                            value="{{ $partner->name }}">
                        <br>
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email"
                            value="{{ $partner->email }}">
                        <br>
                        <label class="lead my-2">Equipo</label>
                        <select class="form-select" name='team_id' id="teams">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" {{ $team->id == $partner->team_id ? 'selected' : '' }}>
                                    {{ $team->name }}</option>
                            @endforeach
                        </select>
                        <br>

                        <input type="submit" class="btn btn-secondary" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('footer')
</body>

</html>
