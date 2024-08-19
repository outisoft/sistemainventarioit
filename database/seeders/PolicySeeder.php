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
            ['name' => 'MEX_TULUMTCC'],
            ['name' => 'MEX_TURISCAR'],
            ['name' => 'MEX_EISIHOTEL_2'],
            ['name' => 'MEX_ESIHOTEL'],
            ['name' => 'MEX_ENTRETENIMIENTO&HOSTESS'],
            ['name' => 'MEX_SEGURIDAD'],
            ['name' => 'MEX_STOCK',],
            ['name' => 'MEX_SCUBA'],
            ['name' => 'MEX_ALMACEN'],
            ['name' => 'MEX_COMANDEROS'],
            ['name' => 'MEX_CO2'],
            ['name' => 'SIN POLITICA APLICADA'],
        ];

        // Agregar los datos a la tabla "hoteles"
        DB::table('policies')->insert($datos);
    }
}
