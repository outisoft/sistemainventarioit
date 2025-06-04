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

        return $empleados->flatMap(function ($empleado) {
            return $empleado->equipos->map(function ($equipo) use ($empleado) {
                return [
                    'No. employee' => $empleado->no_empleado,
                    'Name' => $empleado->name,
                    'Email' => $empleado->email,
                    'Hotel' => $empleado->hotel->name ?? 'N/A',
                    'Department' => $empleado->departments->name ?? 'N/A',
                    'Job' => $empleado->puesto,
                    'AD' => $empleado->ad,
                    'Equipment - Type' => $equipo->tipo->name ?? 'N/A',
                    'Equipment - Brand' => $equipo->marca ?? 'N/A',
                    'Equipment - Model' => $equipo->model ?? 'N/A',
                    'Equipment - Serial' => $equipo->serial ?? 'N/A',
                    'Equipment - Name' => $equipo->name ?? 'N/A',
                    'Equipment - IP' => $equipo->ip ?? 'N/A',
                    'Complements - Type' => $empleado->equipos->flatMap->complements->pluck('type.name')->filter()->join(', '),
                    'Complements - Brand' => $empleado->equipos->flatMap->complements->pluck('brand')->filter()->join(', '),
                    'Complements - Model' => $empleado->equipos->flatMap->complements->pluck('model')->filter()->join(', '),
                    'Complements - Serial' => $empleado->equipos->flatMap->complements->pluck('serial')->filter()->join(', '),
                    'License - Type' => $empleado->equipos->flatMap->license->pluck('type')->filter()->join(', '),
                    'License - Key' => $empleado->equipos->flatMap->license->pluck('key')->filter()->join(', '),
                ];
            });
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
