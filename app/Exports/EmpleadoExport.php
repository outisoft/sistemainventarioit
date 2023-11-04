<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmpleadoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Inventario::all();
        return Empleado::get(['id','no_empleado', 'name', 'email', 'puesto', 'departamento_id', 'hotel_id', 'ad']);
    }

    public function headings(): array
    {
        return ['id','no_empleado', 'name', 'email', 'puesto', 'departamento_id', 'hotel_id', 'ad'];
    }
}
