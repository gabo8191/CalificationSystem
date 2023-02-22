<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    @include('nav')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container">
        <div class="col-md-6 px-0">
            <h1 class="display-4 font-italic">FORMULARIO DE CALIFICACIÓN INTERNO</h1>

            <h2 class="lead my-3 text-success display-5 font-weight-normal">
                BIENVENIDO,
                {{ Auth::user()->name }}
            </h2>
        </div>


        <div class="col-md-8 order-md-1">
            <form class="needs-validation" action="{{ route('formulario.index') }}" method="get" autocomplete="off">
                <div class="row">

                    <label class="lead my-2">Equipo</label>
                    <select class="form-select" name='team_id' id="items">
                        <option value="{{ isset($filter) ? $filter : '' }}">
                            @if (isset($filter))
                                @foreach ($teams as $team)
                                    @if ($filter == $team->id)
                                        {{ $team->name }}
                                    @endif
                                @endforeach
                            @else
                                Seleccione un equipo
                            @endif
                        </option>
                        @foreach ($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }}</option>
                        @endforeach
                    </select>
                    <input class="btn btn-secondary" type="submit" value="Filtrar">

                </div>
            </form>
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
        <div class="col-md-8 order-md-1">

            <form class="needs-validation" action="{{ route('formulario.store') }}" method="post" autocomplete="off">
                @csrf

                @if (isset($filter))
                    <input type="hidden" name="team_id" value="{{ $filter }}">
                @endif

                @if (isset($filter))
                    <div class="row">

                        <label class="lead my-2">Nombre del colaborador</label>
                        <select class="form-select" name='partner_id' id="partners">
                            <option value="0" selected>Seleccione un colaborador</option>
                            @foreach ($partners as $partner)
                                @if ($filter == $partner->team_id)
                                    <option value=" {{ $partner->id }}"
                                        {{ $answers_id_partner->contains($partner->id) ? 'disabled' : '' }}>
                                        {{ $partner->name }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                @endif

                <br>

                @if ($questions->isEmpty())
                    <h3 class="text-danger">NO HAY PREGUNTAS</h3>
                @else
                    <div class="mb-3">

                        <h3 class="text-muted lead">Por favor califique de 1 a 5, siendo 5 la máxima calificación, las
                            siguientes preguntas</h3>
                        @foreach ($questions as $question)
                            <fieldset class="form-group border p-3">
                                <legend class="scheduler-border w-auto px-2">
                                    {{ $counter++ }}-{{ $question->concepto_pregunta }}</legend>

                                <br>
                                <input class="form-check-input" type="radio" name="respuesta[] {{ $question->id }}"
                                    value="1" />
                                <label class="form-check-label" for="respuesta_1">1</label>
                                <input class="form-check-input" type="radio" name="respuesta[] {{ $question->id }}"
                                    value="2" />
                                <label class="form-check-label" for="respuesta_2">2</label>
                                <input class="form-check-input" type="radio" name="respuesta[] {{ $question->id }}"
                                    value="3" />
                                <label class="form-check-label" for="respuesta_3">3</label>
                                <input class="form-check-input" type="radio" name="respuesta[] {{ $question->id }}"
                                    value="4" />
                                <label class="form-check-label" for="respuesta_4">4</label>
                                <input class="form-check-input" type="radio" name="respuesta[] {{ $question->id }}"
                                    value="5" />
                                <label class="form-check-label" for="respuesta_5">5</label>
                            </fieldset>
                            <br>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <br>
                        @endforeach
                    </div>
                    <input class="btn btn-primary btn-lg btn-block " type="submit" value="Enviar">
            </form>
            @endif

        </div>

    </div>

    @include('footer')

    <script>
        $(document).ready(function() {
            $('#items').change(function() {
                var team_id = $(this).val();
                $.ajax({
                    url: "{{ route('formulario.index') }}",
                    method: "GET",
                    data: {
                        team_id: team_id
                    },
                    success: function(data) {
                        $('#partners').html(data);
                    }
                });
            });
        });
    </script>

    <script></script>

</body>

</html>
