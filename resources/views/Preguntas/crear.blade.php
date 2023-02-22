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
            <h1 class="display-4 font-weight-normal">CREAR UNA NUEVA PREGUNTA</h1>
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

            <form class="needs-validation" action="{{ route('pregunta.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="row">

                    <label for="pregunta">Concepto de la pregunta</label>
                    <input class="form-control" type="text" name="pregunta" id="pregunta">
                    <input type="submit" value="Enviar">
                </div>
            </form>
            <br>
            @if (session('status'))
                <h3>{{ session('status') }}</h3>
            @endif
            <br>
        </div>
    </div>
    @include('footer')

</body>

</html>
