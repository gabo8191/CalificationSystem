<table class="table table-striped table-sm" id="resumeTeams">
    <thead>
        <tr>
            <th>Equipo</th>
            <th>Cantidad de respuestas</th>
            <th>Calificación</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teamsData as $team)
            <tr>
                <td>{{ $team->name }}</td>
                <td>{{ $countTeams[$team->id] }}</td>
                <td class="text-center"
                style="color: {{ $averageTeams[$team->id] < 3 ? 'red' : 'green' }};font-weight:bold">
                {{ $averageTeams[$team->id] }}
            </td>
            </tr>
        @endforeach

    </tbody>
</table>