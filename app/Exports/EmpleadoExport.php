<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class EmpleadoExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Empleado::get(['id', 'no_empleado', 'name', 'email', 'puesto', 'departamento_id', 'hotel_id', 'ad']);
        // Obtener los datos de la gráfica
        /*$datos = DB::table('empleados')
            ->join('hotels', 'empleados.hotel_id', '=', 'hotels.id')
            ->select('hotels.nombre as hotel', DB::raw('count(*) as cantidad_empleados'))
            ->groupBy('hotels.nombre')
            ->get();

        // Devolver los datos como una colección
        return collect($datos);*/
    }
    /*public function collection()
    {
        //return Inventario::all();
        return Empleado::get(['id','no_empleado', 'name', 'email', 'puesto', 'departamento_id', 'hotel_id', 'ad']);
    }*/

    public function headings(): array
    {
        return ['id', 'no_empleado', 'name', 'email', 'puesto', 'departamento_id', 'hotel_id', 'ad'];
    }
}
