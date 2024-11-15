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
            ['name' => 'AKUMAL', 'type' => 'LUXURY', 'country' => 'MÉXICO'],
            ['name' => 'COBA', 'type' => 'GRAND', 'country' => 'MÉXICO'],
            ['name' => 'COMING2', 'type' => 'SISTER COMPANY', 'country' => 'MÉXICO'],
            ['name' => 'JAMAICA', 'type' => 'GRAND', 'country' => 'JAMAICA'],
            ['name' => 'RUNAWAY BAY ', 'type' => 'LUXURY', 'country' => 'JAMAICA'],
            ['name' => 'SCUBAQUATIC', 'type' => 'SISTER COMPANY', 'country' => 'MÉXICO'],
            ['name' => 'SERVICIOS COMUNES', 'type' => 'COMMON SERVICES', 'country' => 'MÉXICO'],
            ['name' => 'SIAN KA´AN', 'type' => 'LUXURY', 'country' => 'MÉXICO'],
            ['name' => 'TRAINCAR', 'type' => 'SISTER COMPANY', 'country' => 'MÉXICO'],
            ['name' => 'TULUM', 'type' => 'GRAND', 'country' => 'MÉXICO'],
            ['name' => 'TULUM COUNTRY CLUB', 'type' => 'SISTER COMPANY', 'country' => 'MÉXICO'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('hotels')->insert($datos);
    }
}
