<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['name' => 'APLICACION'],
            ['name' => 'CARGADOR'],
            ['name' => 'DESKTOP'],
            ['name' => 'IMPRESORA'],
            ['name' => 'LAPTOP'],
            ['name' => 'LECTOR'],
            ['name' => 'MONITOR'],
            ['name' => 'MOUSE'],
            ['name' => 'NO BREACK'],
            ['name' => 'OFFICE'],
            ['name' => 'SCANNER'],
            ['name' => 'SO'],
            ['name' => 'TECLADO'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('tipos')->insert($datos);
    }
}
