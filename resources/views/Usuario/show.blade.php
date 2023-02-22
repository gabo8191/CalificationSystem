<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">

</head>

<body>
    @include('nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-normal my-5">LISTADO DE USUARIOS</h1>
            </div>
            <br>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($users->isEmpty())
                <div class="alert alert-danger">
                    <h3>No hay usuarios registrados</h3>
                </div>
            @else
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Usuarios</h5>
                        <div class="btn-group">
                            <a class="btn btn-success" href="{{ route('exportExcel') }}">DESCARGAR EXCEL</a>
                            <a class="btn btn-danger" href="{{ route('exportPdf') }}">DESCARGAR PDF</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-sm" id="users">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Fecha de creación</th>
                                    <th>Fecha de actualización</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at}}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @can('usuario.edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('usuario.edit', $user->id) }}">EDITAR</a>

                                                    <form class="d-inline"
                                                        action="{{ route('usuario.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-danger btn-sm" type="submit"
                                                            value="ELIMINAR">
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
        </div>
        @endif
    </div>
    @include('footer')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#users').DataTable();
        });
    </script>
</body>

</html>
