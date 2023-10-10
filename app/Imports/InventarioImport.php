<?php

namespace App\Imports;

use App\Models\Inventario;
use Maatwebsite\Excel\Concerns\ToModel;

class InventarioImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventario([
            "nombre" => $row[1], 
            "cantidad" => $row[2],
            "precio" => $row[3],
        ]);
    }
}
