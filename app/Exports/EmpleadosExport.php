<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $empleados = Empleado::with('equipos.complements', 'equipos.license')->get();
        
        return $empleados->map(function ($empleado) {
            return [
                'No. employee' => $empleado->no_empleado,
                'Name' => $empleado->name,
                'Email' => $empleado->email,
                'Hotel' => $empleado->hotel->name,
                'Department' => $empleado->departments->name,
                'Job' => $empleado->puesto,
                'AD' => $empleado->ad,
                'Equipment - Type' => $empleado->equipos->pluck('tipo.name')->join(', '),
                'Equipment - Brand' => $empleado->equipos->pluck('marca')->join(', '),
                'Equipment - Model' => $empleado->equipos->pluck('model')->join(', '),
                'Equipment - Serial' => $empleado->equipos->pluck('serial')->join(', '),
                'Equipment - Name' => $empleado->equipos->pluck('name')->join(', '),
                'Equipment - IP' => $empleado->equipos->pluck('ip')->join(', '),
                'Complements - Type' => $empleado->equipos->flatMap->complements->pluck('type.name')->join(', '),
                'Complements - Brand' => $empleado->equipos->flatMap->complements->pluck('brand')->join(', '),
                'Complements - Model' => $empleado->equipos->flatMap->complements->pluck('model')->join(', '),
                'Complements - Serial' => $empleado->equipos->flatMap->complements->pluck('serial')->join(', '),
                'License - Type' => $empleado->equipos->flatMap->license->pluck('type')->join(', '),
                'License - Key' => $empleado->equipos->flatMap->license->pluck('key')->join(', '),
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
