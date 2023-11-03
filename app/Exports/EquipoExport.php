<?php

namespace App\Exports;

use App\Models\Equipo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Equipo::all();
    }*/

    public function collection()
    {
        //return Inventario::all();
        return Equipo::get(['id','tipo_id', 'orden', 'marca', 'modelo', 'serie', 'nombre_equipo', 'ip', 'no_contrato', 'nombre_app', 'so', 'office', 'clave']);
    }

    public function headings(): array
    {
        return ['id','tipo_id', 'orden', 'marca', 'modelo', 'serie', 'nombre_equipo', 'ip', 'no_contrato', 'nombre_app', 'so', 'office', 'clave'];
    }
}
