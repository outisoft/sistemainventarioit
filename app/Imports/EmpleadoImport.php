<?php

namespace App\Imports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\ToModel;

class EmpleadoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Empleado([
            "no_empleado" => $row[1], 
            "name" => $row[2],
            "email" => $row[3],
            "puesto" => $row[4],
            "departamento_id" => $row[5],
            "hotel_id" => $row[6],
            "ad" => $row[7],
        ]);
    }
}
