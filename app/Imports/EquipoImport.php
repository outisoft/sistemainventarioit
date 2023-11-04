<?php

namespace App\Imports;

use App\Models\Equipo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class EquipoImport implements ToModel
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Do something with the data
        }
    }

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new Equipo([
            "tipo_id" => $row[1], 
            "orden" => $row[2],
            "marca" => $row[3],
            "modelo" => $row[4],
            "serie" => $row[5],
            "nombre_equipo" => $row[6],
            "ip" => $row[7],
            "no_contrato" => $row[8],
            "nombre_app" => $row[9],
            "so" => $row[10],
            "office" => $row[11],
            "clave" => $row[12],
        ]);
    }
}
