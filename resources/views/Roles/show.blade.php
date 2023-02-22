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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-normal my-5">LISTADO DE ROLES</h1>
                @can('roles.create')
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">CREAR NUEVO
                            ROL</a>
                    </div>
                @endcan

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($roles->isEmpty())
                    <div class="alert alert-danger">
                        <h3>No hay roles registrados</h3>
                    </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <div class="btn group">
                                                @can('roles.edit')
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('roles.edit', $role->id) }}">Editar</a>

                                                    <form class="d-inline" action="{{ route('roles.destroy', $role->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-sm btn-danger" type="submit"
                                                            value="ELIMINAR">
                                                    @endcan
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('footer')
</body>

</html>
