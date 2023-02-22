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

        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">RESUMEN DE RESULTADOS</h1>

            <h2 class="lead my-3 text-success display-4 font-weight-normal">
                BIENVENIDO,
                {{ Auth::user()->name }}
            </h2>
            <h4 class="lead my-2 ">Los resultados para <strong style="color: red">{{ $partner }}</strong> son:</h4>
        </div>

        <br>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $contador; $i++)
                        <tr>
                            <td>{{ $questions[$i] }}</td>
                            <td>{{ $answers[$i] }}</td>
                        </tr>
                    @endfor

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="1"><strong>PROMEDIO:</strong> </td>
                        @if ($promedio >= 3)
                            <td><strong style="color: green">{{ $promedio }}</strong></td>
                        @else
                            <td><strong style="color: red">{{ $promedio }}</strong></td>
                        @endif
                    </tr>
                </tfoot>
            </table>

        </div>
        <br>
        <div class="my-3 p-3">

            @if ($promedio >= 3)
                <h4 class="display-6">
                    <strong style="color: green">{{ $partner }}</strong> Sí es apto para continuar
                </h4>
            @else
                <h4 class="display-6">
                    <strong style="color: red">{{ $partner }}</strong> NO es apto para continuar
                </h4>
            @endif
        </div>

    </div>

    @include('footer')
</body>

</html>
