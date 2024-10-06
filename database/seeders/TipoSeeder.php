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
            ['name' => 'SCANNER'],
            ['name' => 'DESKTOP'],
            ['name' => 'IMPRESORA'],
            ['name' => 'LAPTOP'],
            ['name' => 'MONITOR'],
            ['name' => 'MOUSE'],
            ['name' => 'NO BREACK'],
            ['name' => 'TECLADO'],
            ['name' => 'WACOM'],
            ['name' => 'TABLET'],
            ['name' => 'OFFICE'],
            ['name' => 'PHONE'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('tipos')->insert($datos);
    }
}
