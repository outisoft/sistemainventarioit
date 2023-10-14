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
            ['nombre' => 'AKUMAL', 'tipo' => 'Luxury'],
            ['nombre' => 'COBA', 'tipo' => 'Grand'],
            ['nombre' => 'COMING2', 'tipo' => 'Externo'],
            ['nombre' => 'R&G', 'tipo' => 'Externo'],
            ['nombre' => 'SCUBAQUATIC', 'tipo' => 'Externo'],
            ['nombre' => 'SERVICIOS COMUNES', 'tipo' => 'Externo'],
            ['nombre' => 'SIAN KA´AN', 'tipo' => 'Luxury'],
            ['nombre' => 'TRAINCAR', 'tipo' => 'Externo'],
            ['nombre' => 'TULUM', 'tipo' => 'Grand'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('hotels')->insert($datos);
    }
}
