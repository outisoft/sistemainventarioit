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
            ['name' => 'AKUMAL', 'type' => 'LUXURY', 'region_id' => 2],
            ['name' => 'COBA', 'type' => 'GRAND', 'region_id' => 2],
            ['name' => 'COMING2', 'type' => 'SISTER COMPANY', 'region_id' => 2],
            ['name' => 'ESMERALDA', 'type' => 'LUXURY', 'region_id' => 4],
            ['name' => 'JAMAICA', 'type' => 'GRAND', 'region_id' => 3],
            ['name' => 'RUNAWAY BAY ', 'type' => 'LUXURY', 'region_id' => 3],
            ['name' => 'SCUBAQUATIC', 'type' => 'SISTER COMPANY', 'region_id' => 2],
            ['name' => 'SERVICIOS COMUNES', 'type' => 'COMMON SERVICES', 'region_id' => 2],
            ['name' => 'SIAN KA´AN', 'type' => 'LUXURY', 'region_id' => 2],
            ['name' => 'TENERIFE', 'type' => 'FANTASIA', 'region_id' => 5],
            ['name' => 'TRAINCAR', 'type' => 'SISTER COMPANY', 'region_id' => 2],
            ['name' => 'TULUM', 'type' => 'GRAND', 'region_id' => 2],
            ['name' => 'TULUM COUNTRY CLUB', 'type' => 'SISTER COMPANY', 'region_id' => 2],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('hotels')->insert($datos);
    }
}
