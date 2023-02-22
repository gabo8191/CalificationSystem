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
                <h1 class="display-4 font-weight-normal my-5">LISTADO DE COLABORADORES</h1>
                @can('partners.create')
                    <div class="d-flex justify-content-end mb-4">
                        <a href="{{ route('partners.create') }}" class="btn btn-primary">CREAR COLABORADOR</a>
                    </div>
                @endcan


                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($partners->isEmpty())
                    <div class="alert alert-danger">
                        No hay colaboradores registrados
                    </div>
                @else
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Colaboradores</h5>
                            <div class="btn-group">
                                <a class="btn btn-success" href="{{ route('exportExcelPartner') }}">DESCARGAR EXCEL</a>
                                <a class="btn btn-danger" href="{{ route('exportPdfPartner') }}">DESCARGAR PDF</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="partners">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Equipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($partners as $partner)
                                        <tr>
                                            <td>{{ $partner->id }}</td>
                                            <td>{{ $partner->name }}</td>
                                            @foreach ($teams as $team)
                                                @if ($team->id == $partner->team_id)
                                                    <td>{{ $team->name }}</td>
                                                @endif
                                            @endforeach
                                            <td>
                                                @can('partners.edit')
                                                    <div class="btn-group">
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('partners.edit', $partner) }}">EDITAR</a>
                                                        <form class="d-inline"
                                                            action="{{ route('partners.destroy', $partner) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input class="btn btn-danger btn-sm" type="submit"
                                                                value="ELIMINAR">
                                                        </form>
                                                    </div>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                @endif

            </div>
        </div>

    </div>
    </div>

    @include('footer')


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#partners').DataTable();
        });
    </script>

</body>

</html>
