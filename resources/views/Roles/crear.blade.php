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


            <form class="needs-validation" action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="row">

                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name">

                    <h2 class="h3">Lista de permisos</h2>
                    @foreach ($permissions as $permission)
                        <div>
                            <label for="">
                                <input class="mr-1" type="checkbox" name="permission[]" id="permission"
                                    value="{{ $permission->id }}"
                                    {{ is_array(old('permission')) && in_array($permission->id, old('permission')) ? 'checked ' : '' }}>
                                {{ $permission->description }}
                            </label>
                        </div>
                    @endforeach
                    <input type="submit" value="Enviar">
                </div>
            </form>

        </div>
    </div>

    @include('footer')
</body>

</html>
