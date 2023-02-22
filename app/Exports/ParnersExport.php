<?php

namespace App\Exports;

use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class ParnersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function title(): string
    {
        return 'Partners';
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



    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'Equipo',
        ];
    }
    public function collection()
    {
        $data = DB::table('partners')
            ->join('teams', 'partners.team_id', '=', 'teams.id')
            ->select('partners.name', 'partners.email', 'teams.name as team')
            ->get();
        return $data;
    }
}
