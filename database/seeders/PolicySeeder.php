<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['name' => 'MEX_TULUMTCC', 'region_id' => 1],
            ['name' => 'MEX_TURISCAR', 'region_id' => 1],
            ['name' => 'MEX_EISIHOTEL_2', 'region_id' => 1],
            ['name' => 'MEX_ESIHOTEL', 'region_id' => 1],
            ['name' => 'MEX_ENTRETENIMIENTO&HOSTESS', 'region_id' => 1],
            ['name' => 'MEX_SEGURIDAD', 'region_id' => 1],
            ['name' => 'MEX_STOCK', 'region_id' => 1],
            ['name' => 'MEX_SCUBA', 'region_id' => 1],
            ['name' => 'MEX_ALMACEN', 'region_id' => 1],
            ['name' => 'MEX_COMANDEROS', 'region_id' => 1],
            ['name' => 'MEX_CO2', 'region_id' => 1],
            ['name' => 'SIN POLITICA APLICADA', 'region_id' => 1],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('policies')->insert($datos);
    }
}
