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
            <h1 class="display-4 font-weight-normal">EDITAR PREGUNTA</h1>
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

            <form class="needs-validation" action="{{ route('pregunta.update', $question->id) }}" method="POST"
                autocomplete="off">
                @csrf
                @method('put')
                <div class="row">
                    <div class=" mb-3">

                        <label>Pregunta: </label>
                        <input class="form-control" type="text" name="pregunta"
                            value="{{ old('pregunta', $question->concepto_pregunta) }}">
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
