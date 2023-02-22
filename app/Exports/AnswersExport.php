<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;


class AnswersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            'id',
            'respuesta',
            'Evaluador',
            'Colaborador evaluado',
            'Equipo',
            'Promedio',
            'Fecha de respuesta'
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

            'F' => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => '00FF00',
                    ],
                ],
            ],

        ];
    }

    public function collection()
    {
        $data = DB::table('answers')
            ->join('users', 'answers.user_id', '=', 'users.id')
            ->join('partners', 'answers.partner_id', '=', 'partners.id')
            ->join('teams', 'answers.team_id', '=', 'teams.id')
            ->select('answers.id', 'answers.respuesta', 'users.name', 'partners.name as partner', 'teams.name as team', 'answers.promedio', 'answers.created_at')
            ->get();
        return $data;
    }
}
