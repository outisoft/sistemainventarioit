<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $empleados = Empleado::with('hotel', 'departments', 'equipos.complements', 'equipos.license')->get();

        return $empleados->map(function ($empleado) {
            return [
                'No. employee' => $empleado->no_empleado,
                'Name' => $empleado->name,
                'Email' => $empleado->email,
                'Hotel' => $empleado->hotel->name ?? 'N/A', // Manejar relaciones vacías
                'Department' => $empleado->departments->name ?? 'N/A',
                'Job' => $empleado->puesto,
                'AD' => $empleado->ad,
                'Equipment - Type' => $empleado->equipos->pluck('tipo.name')->filter()->join(', '),
                'Equipment - Brand' => $empleado->equipos->pluck('marca')->filter()->join(', '),
                'Equipment - Model' => $empleado->equipos->pluck('model')->filter()->join(', '),
                'Equipment - Serial' => $empleado->equipos->pluck('serial')->filter()->join(', '),
                'Equipment - Name' => $empleado->equipos->pluck('name')->filter()->join(', '),
                'Equipment - IP' => $empleado->equipos->pluck('ip')->filter()->join(', '),
                'Complements - Type' => $empleado->equipos->flatMap->complements->pluck('type.name')->filter()->join(', '),
                'Complements - Brand' => $empleado->equipos->flatMap->complements->pluck('brand')->filter()->join(', '),
                'Complements - Model' => $empleado->equipos->flatMap->complements->pluck('model')->filter()->join(', '),
                'Complements - Serial' => $empleado->equipos->flatMap->complements->pluck('serial')->filter()->join(', '),
                'License - Type' => $empleado->equipos->flatMap->license->pluck('type')->filter()->join(', '),
                'License - Key' => $empleado->equipos->flatMap->license->pluck('key')->filter()->join(', '),
            ];
        });
    }

    public function headings(): array
    {
        return [
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
