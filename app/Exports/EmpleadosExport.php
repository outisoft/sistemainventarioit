<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleadosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Empleado::with('hotel', 'departments', 'equipos.tipo', 'equipos.complements.tipo', 'equipos.license')->get()->flatMap(function ($empleado) {
            // Manejar casos en los que no haya equipos, complementos o licencias
            if ($empleado->equipos->isEmpty()) {
                return [
                    [
                        'No. employee' => $empleado->no_empleado,
                        'Name' => $empleado->name,
                        'Email' => $empleado->email,
                        'Hotel' => $empleado->hotel->name ?? 'N/A',
                        'Department' => $empleado->departments->name ?? 'N/A',
                        'Job' => $empleado->puesto,
                        'AD' => $empleado->ad,
                        'Equipment - Type' => 'No equipment assigned',
                        'Equipment - Brand' => '',
                        'Equipment - Model' => '',
                        'Equipment - Serial' => '',
                        'Equipment - Name' => '',
                        'Equipment - IP' => '',
                        'Complements - Type' => '',
                        'Complements - Brand' => '',
                        'Complements - Model' => '',
                        'Complements - Serial' => '',
                        'License - Type' => '',
                        'License - Key' => '',
                    ]
                ];
            }

            return $empleado->equipos->flatMap(function ($equipo) use ($empleado) {
                // Manejo de complementos y licencias cuando no existen
                $complementos = $equipo->complements->isEmpty() ? [['serial' => 'No complements', 'tipo' => ['name' => 'N/A'], 'brand' => '', 'model' => '']] : $equipo->complements;
                $licencias = $equipo->license->isEmpty() ? [['type' => 'No licenses', 'key' => '']] : $equipo->license;

                return collect($complementos)->flatMap(function ($complemento) use ($empleado, $equipo, $licencias) {
                    return collect($licencias)->map(function ($licencia) use ($empleado, $equipo, $complemento) {
                        return [
                            'No. employee' => $empleado->no_empleado,
                            'Name' => $empleado->name,
                            'Email' => $empleado->email,
                            'Hotel' => $empleado->hotel->name ?? 'N/A',
                            'Department' => $empleado->departments->name ?? 'N/A',
                            'Job' => $empleado->puesto,
                            'AD' => $empleado->ad,
                            'Equipment - Type' => $equipo->tipo->name ?? 'N/A',
                            'Equipment - Brand' => $equipo->marca,
                            'Equipment - Model' => $equipo->model,
                            'Equipment - Serial' => $equipo->serial,
                            'Equipment - Name' => $equipo->name,
                            'Equipment - IP' => $equipo->ip,
                            'Complements - Type' => $complemento['tipo']['name'] ?? 'N/A',
                            'Complements - Brand' => $complemento['brand'],
                            'Complements - Model' => $complemento['model'],
                            'Complements - Serial' => $complemento['serial'],
                            'License - Type' => $licencia['type'],
                            'License - Key' => $licencia['key'],
                        ];
                    });
                });
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
