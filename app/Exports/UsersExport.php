<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithStyles
{
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Email',
            'Equipo ID',
            'Rol ID',
        ];
    }

    public function title(): string
    {
        return 'Usuarios';
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

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $users = DB::table('users')
            ->join('teams', 'users.team_id', '=', 'teams.id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'teams.name as team', 'roles.name as role')
            ->get();
        return $users;
    }
}
