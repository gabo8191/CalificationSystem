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
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 text-center">
                <h1 class="display-4 font-italic">RESUMEN DE RESULTADOS</h1>
                <h2 class="lead my-3 text-success display-5 font-weight-normal">
                    BIENVENIDO, {{ Auth::user()->name }}
                </h2>
            </div>
        </div>
        <div class="card my-5">
            <div class="card-header">
                <h2 class="lead my-3 text-success display-4 font-weight-normal">Resultado por colaborador</h2>
                <div class="btn-group d-flex justify-content-end my-2">
                    <a class="btn btn-success mx-1" href="{{ route('exportExcelResults') }}">DESCARGAR EXCEL</a>
                    <a class="btn btn-danger mx-1" href="{{ route('exportPdfResults') }}">DESCARGAR PDF</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="resume">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Equipo</th>
                                <th>Nombre del Colaborador</th>
                                <th>Respuestas</th>
                                <th>Calificación</th>
                                <th>Evaluado por</th>
                                <th>Fecha de la evaluación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < $counter; $i++)
                                <tr>
                                    <td>{{ $id[$i] }}</td>
                                    <td>{{ $teams[$i] }}</td>
                                    <td>{{ $partners[$i] }}</td>
                                    <td>{{ $answers[$i] }}</td>
                                    @if ($promedio[$i] < 3)
                                        <td class="text-center" style="color: red; font-weight: bold;">
                                            {{ $promedio[$i] }}</td>
                                    @else
                                        <td class="text-center" style="color: green; font-weight: bold;">
                                            {{ $promedio[$i] }}</td>
                                    @endif
                                    <td>
                                        @foreach ($users as $user)
                                            @if ($user->id == $user_id[$i])
                                                {{ $user->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $created_at[$i] }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="card my-5">
            <div class="card-header">
                <h2 class="lead my-3 text-success display-4 font-weight-normal">Resultado por equipo</h2>
                <div class="btn-group d-flex justify-content-end my-2">
                    <a class="btn btn-success mx-1" href="{{ route('exportExcelResultsTeams') }}">DESCARGAR EXCEL</a>
                    <a class="btn btn-danger mx-1" href="{{ route('exportPdfResultsTeams') }}">DESCARGAR PDF</a>
                </div>
            </div>
            <div class="card-body p-0">
                @include('Formulario.exports.teamResume')
            </div>
        </div>
    </div>

        @include('footer')

</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#resume').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#resumeTeams').DataTable();
    });
</script>

</html>
