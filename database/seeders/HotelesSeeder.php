<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['name' => 'AKUMAL', 'tipo' => 'Luxury'],
            ['name' => 'COBA', 'tipo' => 'Grand'],
            ['name' => 'COMING2', 'tipo' => 'Externo'],
            ['name' => 'SCUBAQUATIC', 'tipo' => 'Externo'],
            ['name' => 'SERVICIOS COMUNES', 'tipo' => 'Externo'],
            ['name' => 'SIAN KA´AN', 'tipo' => 'Luxury'],
            ['name' => 'TRAINCAR', 'tipo' => 'Externo'],
            ['name' => 'TULUM', 'tipo' => 'Grand'],
            ['name' => 'TULUM COUNTRY CLUB', 'tipo' => 'Externo'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('hotels')->insert($datos);
    }
}
