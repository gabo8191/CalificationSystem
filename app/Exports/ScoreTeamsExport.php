<?php

namespace App\Exports;

use App\Http\Controllers\FormularioController;
use App\Models\Answer;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class ScoreTeamsExport implements FromView, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'Equipo',
            'Cantidad de respuestas',
            'Calificación general'
        ];
    }

    public function title(): string
    {
        return 'Resumen General de Respuestas';
    }

    public function styles($sheet)
    {
        return [
            1    => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'FFFF00',
                    ],
                ],
            ],

        ];
    }


    public function view(): View
    {
        $quantityTeams = Team::count();
        $countTeams = [];
        $sumTeams = [];
        $averageTeams = [];
        $teamsData = Team::all();

        foreach ($teamsData as $team) {
            $countTeams[$team->id] = DB::table('answers')->where('team_id', '=', $team->id)->count();
            $sumTeams[$team->id] = DB::table('answers')->where('team_id', '=', $team->id)->sum('promedio');
            if ($countTeams[$team->id] == 0) {
                $averageTeams[$team->id] = 0;
            } else {
                $averageTeams[$team->id] = $sumTeams[$team->id] / $countTeams[$team->id];
            }
        }

        return view('Formulario.exports.teamResume', compact('teamsData', 'countTeams', 'sumTeams', 'averageTeams'));
    }
}
