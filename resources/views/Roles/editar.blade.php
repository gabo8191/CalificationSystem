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
            <h1 class="display-4 font-weight-normal">EDITAR ROL</h1>
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

            <form class="needs-validation" action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" id="name"
                            value="{{ $role->name }}">
                        <br>
                        <h2 class="h3">Lista de permisos</h2>
                        @foreach ($permissions as $permission)
                            <div>
                                <label for="">
                                    <input class="mr-1" type="checkbox" name="permissions[]" id="permission"
                                        value="{{ $permission->id }}"
                                        {{ is_array(old('permission')) && in_array($permission->id, old('permission')) ? 'checked ' : '' }}
                                        {{ is_array($role->permissions->pluck('id')->toArray()) && in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked ' : '' }} />
                                    {{ $permission->description }}
                                </label>
                            </div>
                        @endforeach
                        <input type="submit" class="btn btn-secondary" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('footer')
</body>

</html>
