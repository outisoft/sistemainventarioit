<?php

namespace App\Exports;

use App\Models\Position;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $positions = Position::with('hotel', 'departments', 'equipments.complements', 'equipments.license')->get();

        return $positions->flatMap(function ($position) {
            return $position->equipments->map(function ($equipo) use ($position) {
                return [
                    'Company' => $position->company->name ?? 'N/A',
                    'No. employee' => $position->employee->no_employee ?? 'N/A',
                    'Name' => $position->employee->name ?? 'N/A',
                    'Email' => $position->email,
                    'Hotel' => $position->hotel->name ?? 'N/A',
                    'Department' => $position->departments->name ?? 'N/A',
                    'Job' => $position->position,
                    'AD' => $position->ad,
                    'Equipment - Type' => $equipo->tipo->name ?? 'N/A',
                    'Equipment - Brand' => $equipo->marca ?? 'N/A',
                    'Equipment - Model' => $equipo->model ?? 'N/A',
                    'Equipment - Serial' => $equipo->serial ?? 'N/A',
                    'Equipment - Name' => $equipo->name ?? 'N/A',
                    'Equipment - IP' => $equipo->ip ?? 'N/A',
                    'Complements - Type' => $position->equipments->flatMap->complements->pluck('type.name')->filter()->join(', '),
                    'Complements - Brand' => $position->equipments->flatMap->complements->pluck('brand')->filter()->join(', '),
                    'Complements - Model' => $position->equipments->flatMap->complements->pluck('model')->filter()->join(', '),
                    'Complements - Serial' => $position->equipments->flatMap->complements->pluck('serial')->filter()->join(', '),
                    'License - Type' => $position->equipments->flatMap->license->pluck('type')->filter()->join(', '),
                    'License - Key' => $position->equipments->flatMap->license->pluck('key')->filter()->join(', '),
                ];
            });
        });
    }

    public function headings(): array
    {
        return [
            'Company',
            'No. employee', 
            'Name', 
            'Email', 
            'Hotel', 
            'Department', 
            'Job', 
            'AD', 
            'Equipment - Type',
            'Equipment - Brand',
            'Equipment - Model',
            'Equipment - Serial',
            'Equipment - Name', 
            'Equipment - IP',
            'Complements - Type',
            'Complements - Brand',
            'Complements - Model',
            'Complements - Serial',
            'License - Type',
            'License - Key',
        ];
    }
}
